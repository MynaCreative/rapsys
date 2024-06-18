<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Invoice;
use App\Models\Oracle\Invoice as OracleInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use App\Models\User;
use App\Models\Vendor;
use Rappasoft\LaravelAuthenticationLog\Models\AuthenticationLog;

use Inertia\Inertia;
use Carbon\Carbon;
use Throwable;

class DashboardController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::pluck('id');
        $usersOnline = [];
        foreach ($users as $user) {
            if (Cache::tags('user-online')->has('user-is-online-' . $user)) {
                $usersOnline[] = $user;
            }
        }
        $authentications = AuthenticationLog::whereNotNull('login_at')->whereNotNull('logout_at')
            ->select("*")
            ->selectRaw('TIMESTAMPDIFF(SECOND, login_at, logout_at) as duration')
            ->get()
            ->avg('duration');
        return Inertia::render("Dashboard", [
            'references' => [
                'total_user' => count($users),
                'total_login' => AuthenticationLog::count(),
                'login_duration' => [
                    'minute' => (int) Carbon::createFromTimestamp($authentications)->format('m'),
                    'second' => (int) Carbon::createFromTimestamp($authentications)->format('s'),
                ],
                'online' => $usersOnline
            ]
        ]);
    }

    /**
     * Display a listing of the ppcr.
     */
    public function chart(Request $request, $type)
    {
        try {
            $data = null;
            switch ($type) {
                case 'invoice-creator':
                    $data = $this->invoiceCreator();
                    break;
                case 'invoice-department':
                    $data = $this->invoiceDepartment();
                    break;
                case 'invoice-vendor':
                    $data = $this->invoiceVendor();
                    break;
                case 'invoice-status':
                    $data = $this->invoiceStatus();
                    break;
                case 'invoice-approval':
                    $data = $this->invoiceApproval();
                    break;
                case 'invoice-staging':
                    $data = $this->invoiceStaging();
                    break;
            }
            return response()->json($data);
        } catch (Throwable $exception) {
            throw $exception;
        }
    }

    private function invoiceCreator()
    {
        return Invoice::join('users', 'invoices.created_by', '=', 'users.id')
            ->selectRaw('users.name as name, COUNT(1) as total')
            ->groupBy('users.name')
            ->orderByDesc('total')
            ->limit(10)
            ->get()
            ->map(function ($item) {
                $name = str($item->name)->lower()->title();
                return [$name, $item->total];
            });
    }

    private function invoiceDepartment()
    {
        return Department::withCount(['invoices'])
            ->orderBy('invoices_count', 'desc')
            ->whereHas('invoices')
            ->limit(10)
            ->get()
            ->map(function ($item) {
                return [$item->name, $item->invoices_count];
            });
    }

    private function invoiceVendor()
    {
        return Vendor::withCount(['invoices'])
            ->orderBy('invoices_count', 'desc')
            ->whereHas('invoices')
            ->limit(10)
            ->get()
            ->map(function ($item) {
                return [$item->name, $item->invoices_count];
            });
    }

    private function invoiceApproval()
    {
        return Invoice::selectRaw('approval_status as name, COUNT(1) as y')
            ->groupBy('approval_status')
            ->orderByDesc('y')
            ->get();
    }

    private function invoiceStatus()
    {
        return Invoice::selectRaw('document_status as name, COUNT(1) as y')
            ->groupBy('document_status')
            ->orderByDesc('y')
            ->get();
    }

    private function invoiceStaging()
    {
        $statuses = [
            'I' => 'Pending',
            'S' => 'Posted',
            'E' => 'Error',
            'G' => 'Failed',
        ];

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $data = OracleInvoice::selectRaw("status, COUNT(*) as total")
            ->whereMonth('creation_date', $currentMonth)
            ->whereYear('creation_date', $currentYear)
            ->groupBy('status')
            ->get();

        $totalPercentage = $data->sum('total');

        $chartData = $data->map(function ($item) use ($statuses, $totalPercentage) {
            $percentage = round(($item->total / $totalPercentage) * 100, 2);
            return [
                'name' => $statuses[$item->status],
                'y' => $percentage,
            ];
        });

        $trackColors = [ // Assuming you have an array of colors for tracks
            '#eee',
            '#ccc',
            '#aaa',
        ];

        $totalRadius = isset($totalRadius) ? $totalRadius : 100; // Assuming total radius is provided from the view

        return [
            'pane' => array_map(function ($trackColor, $index) use ($totalRadius, $trackColors) {
                $ratio = ($index + 1) / (count($trackColors) + 1);
                return [
                    'outerRadius' => $totalRadius . '%',
                    'innerRadius' => ($ratio * 100 - 10) . '%', // Adjust innerRadius dynamically
                    'backgroundColor' => $trackColor,
                    'borderWidth' => 0,
                ];
            }, $trackColors, array_keys($trackColors)),
            'series' => [
                // Map chartData to series data format
                ...$chartData->map(function ($item) use ($totalRadius) {
                    $angle = $item['y'] / 100 * 360; // Calculate angle based on percentage
                    $innerRadius = $item['y'] > 50 ? ($totalRadius * 0.88) . '%' : ($totalRadius * 0.63) . '%'; // Dynamic innerRadius based on percentage
                    return [
                        'name' => $item['name'],
                        'data' => [
                            [
                                'color' => isset($item['color']) ? $item['color'] : null, // Use existing color if defined
                                'radius' => $totalRadius . '%',
                                'innerRadius' => $innerRadius,
                                'y' => $angle, // Use angle for chart
                            ],
                        ],
                    ];
                }),
            ],
        ];
    }
}

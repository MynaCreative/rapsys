<x-pulse>
    <livewire:pulse.servers cols="full" />

    <livewire:pulse_active_session cols="3" rows="2" />

    <livewire:requests cols="5" />

    <livewire:pulse.usage cols='4' />

    <livewire:pulse.queues cols="5" />

    <livewire:pulse.validation-errors cols="4" />

    <livewire:pulse.slow-queries cols="6" />

    <livewire:pulse.slow-requests cols="6" />

    <livewire:pulse.exceptions cols="6" />

    <livewire:pulse.cache cols="6" />

    <livewire:pulse.slow-jobs cols="6" />

    <livewire:pulse.slow-outgoing-requests cols="6" />

    <livewire:database cols='6' title="Active threads" :values="['Threads_connected', 'Threads_running']" :graphs="[
        'avg' => ['Threads_connected' => '#ffffff', 'Threads_running' => '#3c5dff'],
    ]" />

    <livewire:database cols='6' title="Connections" :values="['Connections', 'Max_used_connections']" />

    <livewire:database cols='6' title="Innodb" :values="['Innodb_buffer_pool_reads', 'Innodb_buffer_pool_read_requests', 'Innodb_buffer_pool_pages_total']" :graphs="[
        'avg' => ['Innodb_buffer_pool_reads' => '#ffffff', 'Innodb_buffer_pool_read_requests' => '#3c5dff'],
    ]" />

    <livewire:pulse.table-info cols='6' />

    <livewire:pulse.about-application cols="3" rows="4" />

    <livewire:apps-load cols="3" rows="4" />

    <livewire:vulnerable cols='6' rows="2" />

    <livewire:outdated cols='6' rows="2" />
</x-pulse>

export default () => {
    return {
        page: {
            module  : 'master',
            name    : 'cost-centers',
            title   : 'Cost Center'
        },
        form: {
            id: null,
            cost_center: null,
            name: null,
            description: null,
            excel_file: null,

            created_at: null,
            updated_at: null,
            created_user: null,
            updated_user: null,
        },
        formExport: {
            type: 'xlsx'
        }
    }
}

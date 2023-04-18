export default () => {
    return {
        page: {
            module  : 'master',
            name    : 'invoice-types',
            title   : 'Invoice Type'
        },
        form: {
            id: null,
            code: null,
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

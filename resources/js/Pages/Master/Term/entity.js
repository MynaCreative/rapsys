export default () => {
    return {
        page: {
            module  : 'master',
            name    : 'terms',
            title   : 'Term'
        },
        form: {
            id: null,
            code: null,
            name: null,
            day: null,
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

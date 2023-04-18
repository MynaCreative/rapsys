export default () => {
    return {
        page: {
            module  : 'master',
            name    : 'taxes',
            title   : 'Tax'
        },
        form: {
            id: null,
            code: null,
            name: null,
            deduction: null,
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

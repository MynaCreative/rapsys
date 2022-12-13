export default () => {
    return {
        page: {
            module  : 'master',
            name    : 'expenses',
            title   : 'Expense'
        },
        form: {
            id: null,
            code: null,
            name: null,
            mandatory_scan: null,
            description: null,
            excel_file: null,

            created_at: null,
            updated_at: null,
            created_user: null,
            updated_user: null,
        }
    }
}

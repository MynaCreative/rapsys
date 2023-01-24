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
            icon: null,
            type: null,
            coa: null,
            coa_description: null,
            mandatory_scan: [],
            description: null,
            excel_file: null,

            created_at: null,
            updated_at: null,
            created_user: null,
            updated_user: null,
        }
    }
}

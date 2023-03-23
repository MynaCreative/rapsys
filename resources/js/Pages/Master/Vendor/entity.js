export default () => {
    return {
        page: {
            module  : 'master',
            name    : 'vendors',
            title   : 'Vendor'
        },
        form: {
            id: null,
            sbu_id: null,
            code: null,
            name: null,
            description: null,
            excel_file: null,

            created_at: null,
            updated_at: null,
            created_user: null,
            updated_user: null,

            sites: []
        }
    }
}

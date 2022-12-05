export default () => {
    return {
        page: {
            module  : 'setting.administrator',
            name    : 'roles',
            title   : 'Role'
        },
        form: {
            id: null,
            name: null,
            guard_name: 'web',
            permissions: [],
            permissions_id: [],
        }
    }
}

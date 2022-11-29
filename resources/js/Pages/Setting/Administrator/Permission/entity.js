export default () => {
    return {
        page: {
            module  : 'setting.administrator',
            name    : 'permissions',
            title   : 'Permission'
        },
        form: {
            id: null,
            label: null,
            name: null,
            guard_name: 'web',
            permission_group_id: null,
        }
    }
}

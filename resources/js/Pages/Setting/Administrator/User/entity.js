export default () => {
    return {
        page: {
            module  : 'setting.administrator',
            name    : 'users',
            title   : 'User'
        },
        form: {
            id: null,
            department_id: null,
            name: null,
            username: null,
            email: null,
            position: null,
            password: null,
            roles: [],
            roles_id: [],
        }
    }
}

export default () => {
    return {
        page: {
            module  : 'setting.configuration',
            name    : 'workflows',
            title   : 'Workflow'
        },
        form: {
            id: null,
            user_id: null,
            sequence: null,
            description: null,
            range_from: 0,
            range_to: 0,
            range: [0,0],
        }
    }
}

import axios from 'axios';

export default {
    async fetchData(module, type, params = null) {
        try {
            const { data } = await axios.get(route(`dashboard.${module}`, { type }), { params });
            return data;
        } catch (error) {
            console.error(error);
        }
    }
};

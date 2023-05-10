import axios from 'axios'
import Swal from 'sweetalert2'
import { router } from '@inertiajs/vue3'

import entityData from './entity'

const page = entityData().page

export default {
    async showData (form, id) {
        const { data : fields } = await axios.get(route(`${page.name}.show`, id))
        Object.keys(fields).forEach((field) => {
            form[field] = fields[field]
        })
    },
    submitData(form, id, emit){
        let method = 'patch'
        let action = route(`${page.name}.update`, form.id)
        form.submit(method, action, {
            onSuccess: () => {
                form.reset()
                form.clearErrors()
            }
        })
    },
}

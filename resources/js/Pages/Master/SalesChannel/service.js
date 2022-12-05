import axios from 'axios'
import Swal from 'sweetalert2'
import { Inertia } from '@inertiajs/inertia'

import entityData from './entity'

const page = entityData().page

export default {
    async showData (form, id) {
        const { data : fields } = await axios.get(route(`${page.module}.${page.name}.show`, id))
        Object.keys(fields).forEach((field) => {
            form[field] = fields[field]
        })
    },
    submitData(form, id, emit){
        let method = form.id ? 'patch' : 'post'
        let action = form.id ? 
            route(`${page.module}.${page.name}.update`, form.id) : 
            route(`${page.module}.${page.name}.store`)
        form.submit(method, action, {
            onSuccess: () => {
                form.reset()
                form.clearErrors()
                emit('update:show',false)
            }
        })
    },
    deleteData(id, undo = false){
        Swal.fire({
            title: `Are you sure you want to ${undo ? 'Restore' : 'Delete'} this item?`,
            text: undo ? false : "Don't worry, you can restore it again.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: `Yes, ${undo ? 'restore' : 'delete'} it!`,
        }).then((result) => {
            if (result.value) {
                Inertia.delete(route(`${page.module}.${page.name}.${undo ? 'restore' : 'destroy'}`, id))
            }
        })
    }
}

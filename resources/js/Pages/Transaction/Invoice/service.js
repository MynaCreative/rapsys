import axios from 'axios'
import Swal from 'sweetalert2'
import { router } from '@inertiajs/vue3'

import entityData from './entity'

const page = entityData().page

export default {
    async showData (form, id) {
        const { data : fields } = await axios.get(route(`${page.module}.${page.name}.show`, id))
        Object.keys(fields).forEach((field) => {
            form[field] = fields[field]
        })
    },
    async showApproval (id) {
        const { data : response } = await axios.get(route(`${page.module}.${page.name}.approval`, id))
        return response
    },
    async smuPreview (code) {
        const { data : fields } = await axios.get(route(`${page.module}.${page.name}.smu-preview`, code))
        return fields
    },
    saveData(form, status){
        let method = form.id ? 'patch' : 'post'
        let action = route(`${page.module}.${page.name}.save`)
        form.transform((data) => ({
            ...data,
            _method: method,
            document_status: status,
        }))
        .submit('post', action, {
            preserveState: (page) => Object.keys(page.props.errors).length,
            preserveScroll: (page) => Object.keys(page.props.errors).length,
        })
    },
    submitData(form, id){
        Swal.fire({
            title: `Are you sure you want to submit this item?`,
            text: "After submitted, all data can't be changed.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: "#3577f1",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: `Submit`,
        }).then((result) => {
            if (result.value) {
                let method = form.id ? 'patch' : 'post'
                let action = form.id ? 
                    route(`${page.module}.${page.name}.update`, form.id) : 
                    route(`${page.module}.${page.name}.store`)
                form.transform((data) => ({
                    ...data,
                    _method: method,
                }))
                .submit('post', action, {
                    preserveState: (page) => Object.keys(page.props.errors).length,
                    preserveScroll: (page) => Object.keys(page.props.errors).length,
                })
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
                router.delete(route(`${page.module}.${page.name}.${undo ? 'restore' : 'destroy'}`, id))
            }
        })
    }
}

export default () => {
    return {
        page: {
            module  : 'transaction',
            name    : 'invoices',
            title   : 'Invoice'
        },
        form: {
            due_date: null,
            term_date: null,
            posting_date: null,
            invoice_date: null,
            invoice_receipt_date: null,
            invoice_number:null,
            supplier_tax_invoice:null,
            supplier_tax_invoice_date:null,
            department_id: null,
            department: null,
            sbu_id: null,
            sbu: null,
            invoice_type_id: null,
            invoice_type: null,
            currency_id: null,
            currency: null,
            interco_id: null,
            interco: null,
            term_id: null,
            term: null,
            vendor_id: null,
            vendor_site_id: null,
            vendor: null,
            vendor_site: null,
            cost_center_id: null,
            note: null,
            total_amount: 0,
            total_amount_valid: 0,
            total_amount_invalid: 0,
            expenses: [
                {
                    cost_center_id: null,
                    withholding_id: null,
                    tax_id: null,
                    area_id: null,
                    product_id: null,
                    sales_channel_id: null,
                    expense_id: 1,
                    expense: {
                        id:1,
                        code:'MNL',
                        icon:'ri-picture-in-picture-line',
                        name:'Manual',
                    },
                }
            ],
            items: [],
            attachments: [],

            uploads: [],
        }
    }
}

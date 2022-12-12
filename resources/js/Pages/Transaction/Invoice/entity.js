export default () => {
    return {
        page: {
            module  : 'transaction',
            name    : 'invoices',
            title   : 'Invoice'
        },
        form: {
            id: null,
            due_date: null,
            term_date: null,
            posting_date: null,
            invoice_date: null,
            invoice_receipt_date: null,
            invoice_number:null,
            term_id: null,
            term: null,
            vendor_id: null,
            vendor: null,
            description: null,
        }
    }
}

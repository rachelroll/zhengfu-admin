Nova.booting((Vue, router, store) => {
    Vue.component('custom-detail-toolbar', require('./components/CustomDetailToolbar'));

    Vue.component('quote-items-detail-toolbar', require('./components/QuoteItemsDetailToolbar'));

    Vue.component('quotes-detail-toolbar', require('./components/QuoteDetailToolbar'));
    Vue.component('countries-detail-toolbar', require('./components/CountryDetailToolbar'));
})

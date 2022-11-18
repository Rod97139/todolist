const orderOption = document.getElementById('order');
const pagination_links = document.querySelectorAll('.page-link_action')



orderOption.addEventListener('change', () => {
    
    const url = new URL(window.location.href);
    url.searchParams.set('order', orderOption.value);
    window.location.href =  url.href;

})


pagination_links.forEach((pagination_link) => {
    
    pagination_link.addEventListener('click' , (e) => {
        e.preventDefault();
        const page_number = pagination_link.dataset.pageNumber
        const url = new URL(window.location.href);
        url.searchParams.set('page', page_number);
        window.location.href =  url.href;
    })
})

export default {
    meta: (title, desc) => {
        const tags = [
            {
                selector: 'twitter:title',
                attr: 'name',
                fill: title,
            },
            {
                selector: 'og:title',
                attr: 'property',
                fill: title,
            },
            {
                selector: 'description',
                attr: 'name',
                fill: desc,
            },
            {
                selector: 'twitter:description',
                attr: 'name',
                fill: desc,
            },
            {
                selector: 'og:description',
                attr: 'property',
                fill: desc,
            },
        ];
        document.title = title;
        tags.forEach(tag => {
            const element = document.querySelector(`head meta[${tag.attr}='${tag.selector}']`);
            element.setAttribute('content', tag.fill);
        })
    }
}

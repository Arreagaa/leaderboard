const setConfig = ()=>{
    return {
        baseUrl: '/diradmin/categories',
        baseUrlCreate: '/diradmin/categories/create',
        baseUrlDelete: 'categories.destroy',
        title: 'Categories',
        titleSingle: 'Category',
        url: 'categories.store',
        method: 'post',
        typeForm: 'Create',
        resource: {
            name: '',
            abreviature: '',
            color: ''
        },
        fields: [
          {
            name: 'name',
            label: 'Name',
            type: 'text',
            typeField: 'input',
            required: true,
            placeholder: 'Name',
          },
          {
            name: 'abreviature',
            label: 'Abreviature',
            type: 'text',
            typeField: 'input',
            required: true,
            placeholder: 'Abreviature',
          },
          {
            name: 'color',
            label: 'Color',
            type: 'color',
            typeField: 'input',
            required: true,
            placeholder: 'Color',
          },
        ],
      }
}

export default setConfig
const setConfig = ()=>{
  return {
    baseUrl: '/diradmin/events',
    baseUrlCreate: '/diradmin/events/create',
    baseUrlDelete: 'events.destroy',
    title: 'Events',
    titleSingle: 'Event',   
    url: 'events.store',
    method: 'post',
    typeForm: 'Create',
    resource: {
      name: '',
      description: ''
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
        name: 'description',
        label: 'Description',
        type: 'text',
        typeField: 'textarea',
        required: true,
        placeholder: 'Description',
      },
    ],
  }
}

export default setConfig
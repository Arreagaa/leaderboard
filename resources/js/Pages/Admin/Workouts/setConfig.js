const setConfig = ()=>{
  return {
    baseUrl: '/diradmin/workouts',
    baseUrlCreate: '/diradmin/workouts/create',
    baseUrlDelete: 'workouts.destroy',
    title: 'Workouts',
    titleSingle: 'Event',   
    url: 'workouts.store',
    method: 'post',
    typeForm: 'Create',
    resource: {
      name: '',
      description: '',
      competition_type_id: null,
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
      {
        name: 'competition_type_id',
        label: 'Competition Type',
        url: '/only/competitions/types',
        type: 'name',
        labelShow: 'competition_type_name',
        typeField: 'select',
        required: true,
        placeholder: 'Competition Type',
      },
    ],
  }
} 

export default setConfig
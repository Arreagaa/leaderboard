const setConfig = ()=>{
    return {
        baseUrl: '/diradmin/competitions',
        baseUrlCreate: '/diradmin/competitions/create',
        baseUrlDelete: 'competitions.destroy',
        title: 'Competitions',
        titleSingle: 'Competition',        
        url: 'competitions.store',
        method: 'post',
        typeForm: 'Create',
        resource: {
            name: '',
            color: '',
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
            name: 'color',
            label: 'Color',
            type: 'text',
            typeField: 'input',
            required: true,
            placeholder: 'Color', 
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
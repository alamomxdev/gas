const getMenu = ( uid, genopt='' ) =>{
    const settings = {
        'url'    : apiObj.host+'/api/roles/rights/'+uid,
        'method' :'POST',
        'timeout':0,
        'async'  : true,
        'headers':{
            'x-token': localStorage.getItem('x-token')
        }
    };

    $('#ul_menus').html('');

    $.ajax( settings )
        .done( (response) => {
            
            const { rights, types } = response;

            if( types.includes('menu-cat') )
                $('#cats_title').removeClass('d-none');

            $(rights).each( (i ,v) => {
                let menu = `
                        <li class="nav-item">
                            <a class="nav-link ${ (v.option==genopt)?'active':'' } " aria-current="page" href="${ (v.option)?v.option:'' }">
                                <i class="${ v.icon }"></i>
                                ${ v.name }
                            </a>
                        </li>
                    `;

                if( v.type==='menu-tools' )
                    $('#ul_menus').append( menu );

                if( v.type==='menu-cat' )
                    $('#ul_cats').append( menu );

            });
        })
        .fail( (errors) => {
            console.log( errors );
        });
}
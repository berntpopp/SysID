$("#t-wing-screen").jqGrid({
        url: 'get-data/wing-screen',
        datatype: "json",
        height: '100%',
        autowidth: false,
        mtype: "GET",
        colNames: ['Id', 'Human gene id', 'Fly gene id', 'Human gene symbol', 'Entrez id', 'Gene group', 'Flybase id', 'Fly gene symbol', 'CG number', 'Gene name', 'VDRC number', 'Any phenotype', 'Lethality', 'Overall wing shape', 'Cupped/Curled', 'Size', 'Adhesion', 'Posterior Margin', 'Notched', 'Hairs missing', 'Wing fields', 'Trichomes missing', 'Trichomes density', 'Trichomes disorganized', 'Trichomes morphology', 'Pigmented spots', 'Veins', 'Veins missing', 'Veins extra', 'Sensory organs / bristles'],
        colModel: [
            {name: "id",title:false, hidden: true},
            {name: "human_gene_id",title:false, hidden: true},
            {name: "fly_gene_id",title:false, hidden: true},
            {name: "human_gene_symbol",title:false, width: "110", formatter: returnHumanHyperLink, sorttype: 'string', searchoptions: {sopt: ['cn', 'nc', 'eq', 'ne', 'bw', 'bn', 'ew', 'en', 'in', 'ni']}},
            {name: "entrez_id",title:false, width: "100", align: "center", formatter: returnEntrezHyperLink, sorttype: 'integer', searchoptions: {sopt: ['eq', 'ne', 'lt', 'le', 'gt', 'ge', 'in', 'ni']}},
            {name: "gene_group",title:false, width: "180", stype: 'select', searchoptions: {sopt: ['eq'], value: ":All;ID data freeze 388:ID data freeze 388;Negative control ID screen:Negative control ID screen"}},
            {name: "flybase_id",title:false, width: "110", formatter: returnFlyHyperLink, sorttype: 'string', searchoptions: {sopt: ['cn', 'nc', 'eq', 'ne', 'bw', 'bn', 'ew', 'en', 'in', 'ni']}},
            {name: "fly_gene_symbol",title:false, width: "120", sorttype: 'string', searchoptions: { sopt: ['cn', 'nc', 'eq','ne', 'bw', 'bn', 'ew', 'en']}},
            {name: "cg_number",title:false, width: "120", align: "center", sorttype: 'string', searchoptions: { sopt: ['cn', 'nc', 'eq','ne', 'bw', 'bn', 'ew', 'en'] } },
            {name: "gene_name",title:false, width: "200", sorttype: 'string', searchoptions: { sopt: ['cn', 'nc', 'eq','ne', 'bw', 'bn', 'ew', 'en']}},
            {name: "order_number",title:false, width: "120", sorttype: 'string', searchoptions: { sopt: ['cn', 'nc', 'eq','ne', 'bw', 'bn', 'ew', 'en']}},
            {name: "any_phenotype",title:false, width: "120", sorttype: 'string', searchoptions: {sopt: ['cn', 'nc', 'eq', 'ne', 'bw', 'bn', 'ew', 'en']}},
            {name: "lethality",title:false, width: "120", sorttype: 'string', searchoptions: {sopt: ['cn', 'nc', 'eq', 'ne', 'bw', 'bn', 'ew', 'en']}},
            {name: "wing_shape_growth_overview",title:false, width: "120", sorttype: 'string', searchoptions: {sopt: ['cn', 'nc', 'eq', 'ne', 'bw', 'bn', 'ew', 'en']}},
            {name: "wing_shape_curled_cupped",title:false, width: "120", sorttype: 'string', searchoptions: {sopt: ['cn', 'nc', 'eq', 'ne', 'bw', 'bn', 'ew', 'en']}},
            {name: "wing_shape_size",title:false, width: "120", sorttype: 'string', searchoptions: {sopt: ['cn', 'nc', 'eq', 'ne', 'bw', 'bn', 'ew', 'en']}},
            {name: "wing_shape_adhesion_severity",title:false, width: "120", sorttype: 'string', searchoptions: {sopt: ['cn', 'nc', 'eq', 'ne', 'bw', 'bn', 'ew', 'en']}},
            {name: "wing_inteveincell_posterior_wing_margin_overview",title:false, width: "120", sorttype: 'string', searchoptions: {sopt: ['cn', 'nc', 'eq', 'ne', 'bw', 'bn', 'ew', 'en']}},
            {name: "wing_interveincell_disruption_notched",title:false, width: "120", sorttype: 'string', searchoptions: {sopt: ['cn', 'nc', 'eq', 'ne', 'bw', 'bn', 'ew', 'en']}},
            {name: "wing_inerveincell_non_innervated_hairs_missing",title:false, width: "120", sorttype: 'string', searchoptions: {sopt: ['cn', 'nc', 'eq', 'ne', 'bw', 'bn', 'ew', 'en']}},
            {name: "wing_interveincell_polarity_hairs_overview",title:false, width: "120", sorttype: 'string', searchoptions: {sopt: ['cn', 'nc', 'eq', 'ne', 'bw', 'bn', 'ew', 'en']}},
            {name: "wing_interveincell_hairs_missing",title:false, width: "120", sorttype: 'string', searchoptions: {sopt: ['cn', 'nc', 'eq', 'ne', 'bw', 'bn', 'ew', 'en']}},
            {name: "wing_interveincell_hair_density",title:false, width: "120", sorttype: 'string', searchoptions: {sopt: ['cn', 'nc', 'eq', 'ne', 'bw', 'bn', 'ew', 'en']}},            
            {name: "wing_interveincell_hairs_disorganized",title:false, width: "120", sorttype: 'string', searchoptions: {sopt: ['cn', 'nc', 'eq', 'ne', 'bw', 'bn', 'ew', 'en']}},            
            {name: "wing_interveincell_hair_morphology",title:false, width: "120", sorttype: 'string', searchoptions: {sopt: ['cn', 'nc', 'eq', 'ne', 'bw', 'bn', 'ew', 'en']}},
            {name: "wing_interveincell_pigmented_spots",title:false, width: "120", sorttype: 'string', searchoptions: {sopt: ['cn', 'nc', 'eq', 'ne', 'bw', 'bn', 'ew', 'en']}},
            {name: "wing_noninterveincell_veins_overview",title:false, width: "120", sorttype: 'string', searchoptions: {sopt: ['cn', 'nc', 'eq', 'ne', 'bw', 'bn', 'ew', 'en']}},
            {name: "wing_noninterveincell_veins_missing",title:false, width: "120", sorttype: 'string', searchoptions: {sopt: ['cn', 'nc', 'eq', 'ne', 'bw', 'bn', 'ew', 'en']}},
            {name: "wing_noninterveincell_extra_veins",title:false, width: "120", sorttype: 'string', searchoptions: {sopt: ['cn', 'nc', 'eq', 'ne', 'bw', 'bn', 'ew', 'en']}},
            {name: "wing_noninterveincell_sensoryorgan_overview",title:false, width: "120", sorttype: 'string', searchoptions: {sopt: ['cn', 'nc', 'eq', 'ne', 'bw', 'bn', 'ew', 'en']}}
            
        ],
        shrinkToFit: true,
        rowNum: 30,
        rowList: [10, 20, 30, 40, 50, 1000000],
        loadComplete: function() {LoadCompleteCustomize("wing-screen");},
        gridComplete: function() {GridCompleteCustomize("wing-screen");},
        pager: "#pager-t-wing-screen",
        sortname: "flybase_id",
        viewrecords: true,
        sortorder: "asc",
        gridview: true,
        autoencode: true,
        caption: "Wing screen",
        toolbar: [true,"bottom"]
    });
    
    CustomizeTable("wing-screen", 3340);
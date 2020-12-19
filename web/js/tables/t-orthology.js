$("#t-orthology").jqGrid({
        url: 'get-data/orthology',
        datatype: "json",
        height: '100%',
        autowidth: false,
        mtype: "GET",
        colNames: ['Orthology id','Human gene id', 'Human gene symbol', 'Fly gene id', 'Flybase id', 'Orthology relationship', 'Orthology determination'],
        colModel: [
            {name: "orthology_id",title:false, hidden: true},
            {name: "human_gene_id",title:false, hidden: true},
            {name: "gene_symbol",title:false, width: "150", sorttype: 'string', formatter: returnHumanHyperLink, searchoptions: {sopt: ['cn', 'nc', 'eq', 'ne', 'bw', 'bn', 'ew', 'en', 'in', 'ni']}},
            {name: "fly_gene_id",title:false, hidden: true},
            {name: "flybase_id",title:false, width: "150", sorttype: 'string', formatter: returnFlyHyperLink, searchoptions: {sopt: ['cn', 'nc', 'eq', 'ne', 'bw', 'bn', 'ew', 'en', 'in', 'ni']}},
            {name: "orthology_relationship",title:false, width: "150", stype: 'select', searchoptions: {sopt: ['cn'], value: ":All;many2many:many to many;many2one:many to one;mitochondrial:mitochondrial;one2many:one to many;one2one:one to one;unclear:unclear"}},            
            {name: "orthology_determination",title:false, width: "150", stype: 'select', searchoptions: {value: ":All;ensembl:Ensembl;manually curated:Manually curated"}}
        ],
        shrinkToFit: false,
        rowNum: 30,
        rowList: [10, 20, 30, 40, 50, 1000000],
        loadComplete: function () {LoadCompleteCustomize("orthology");},
        gridComplete: function () {GridCompleteCustomize("orthology");},
        pager: "#pager-t-orthology",
        sortname: "human_gene_id",
        viewrecords: true,
        sortorder: "asc",
        gridview: true,
        autoencode: true,
        caption: "Orthology",
        toolbar: [true,"bottom"]
    });
    
    CustomizeTable("orthology", 600);
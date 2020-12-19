$("#t-motif").jqGrid({
        url: 'get-data/motif',
        datatype: "json",
        height: '100%',
        autowidth: false,
        mtype: "GET",
        colNames: ['Human gene id', 'Human gene symbol', 'Motifs', 'Score', 'Link'],
        colModel: [            
            {name: "human_gene_id",title:false, hidden: true},
            {name: "gene_symbol",title:false, width: "200", sorttype: 'string', formatter: returnHumanHyperLink, searchoptions: {sopt: ['cn', 'nc', 'eq', 'ne', 'bw', 'bn', 'ew', 'en', 'in', 'ni']}},
            {name: "motifs",title:false, width: "1500",sorttype: 'string', formatter: returnSpanedMotifs, searchoptions: {sopt: ['cn', 'nc']}},            
            {name: "score",title:false, width: "150", align: "right", sorttype: 'integer', searchoptions: {sopt: ['eq', 'ne', 'lt', 'le', 'gt', 'ge']}},
            {name: "link",title:false, width: "0", hidden: true}
        ],
        shrinkToFit: false,
        rowNum: 12,
        rowList: [10, 20, 30, 40, 50, 1000000],
        loadComplete: function () {LoadCompleteCustomize("motif");},
        gridComplete: function () {GridCompleteCustomize("motif");},
        pager: "#pager-t-motif",
        sortname: "human_gene_id",
        viewrecords: true,
        sortorder: "asc",
        gridview: true,
        autoencode: true,
        caption: "Motifs",
        toolbar: [true,"bottom"]
    });
    
    CustomizeTable("motif", 600);



$("#t-fly-gene-info").jqGrid({
        url: 'get-data/fly-gene-info',
        datatype: "json",
        height: '100%',
        autowidth: false,
        mtype: "GET",
        colNames: ['Fly gene id', 'Flybase id', 'Gene name', 'Gene symbol', 'Gene synonyms', 'Secondary flybase ids', 'Fly gene remark', 'CG number'],
        colModel: [
            { name: "fly_gene_id",title:false, hidden: true },
            { name: "flybase_id",title:false, width: "120", formatter: returnFlyHyperLink, sorttype: 'string', searchoptions: { sopt: ['cn', 'nc', 'eq','ne', 'bw', 'bn', 'ew', 'en', 'in', 'ni'] } },
            { name: "gene_name",title:false, width: "200", sorttype: 'string', searchoptions: { sopt: ['cn', 'nc', 'eq','ne', 'bw', 'bn', 'ew', 'en'] } },
            { name: "gene_symbol",title:false, width: "120", sorttype: 'string', searchoptions: { sopt: ['cn', 'nc', 'eq','ne', 'bw', 'bn', 'ew', 'en'] } },
            { name: "gene_synonyms",title:false, width: "400", sorttype: 'string', searchoptions: { sopt: ['cn', 'nc', 'eq','ne', 'bw', 'bn', 'ew', 'en'] } },
            { name: "secondary_flybase_ids",title:false, width: "200", sorttype: 'string', searchoptions: { sopt: ['cn', 'nc', 'eq','ne', 'bw', 'bn', 'ew', 'en'] } },
            { name: "fly_gene_remark",title:false, hidden: true },
            { name: "cg_number",title:false, width: "120", align: "center", sorttype: 'string', searchoptions: { sopt: ['cn', 'nc', 'eq','ne', 'bw', 'bn', 'ew', 'en'] } },
        ],
        shrinkToFit: true,
        rowNum: 30,
        rowList: [10, 20, 30, 40, 50, 1000000],
        loadComplete: function() {LoadCompleteCustomize("fly-gene-info");},
        gridComplete: function() {GridCompleteCustomize("fly-gene-info");},
        pager: "#pager-t-fly-gene-info",
        sortname: "fly_gene_id",
        viewrecords: true,
        sortorder: "asc",
        gridview: true,
        autoencode: true,
        caption: "Fly gene info",
        toolbar: [true,"bottom"]
    });
    
    CustomizeTable("fly-gene-info", 1060);
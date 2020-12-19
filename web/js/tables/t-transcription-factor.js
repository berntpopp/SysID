$("#t-transcription-factor").jqGrid({
        url: 'get-data/transcription-factor',
        datatype: "json",
        height: '100%',
        autowidth: false,
        mtype: "GET",
        colNames: ['Human gene id', 'Gene symbol','Transcription factors', 'Transcription factors which are ID genes themselves'],
        colModel: [
            {name: "human_gene_id",title:false, hidden: true},            
            {name: "gene_symbol",title:false, width: "150", sorttype: 'string', formatter: boldTf, searchoptions: {sopt: ['cn', 'nc', 'eq', 'ne', 'bw', 'bn', 'ew', 'en', 'in', 'ni']}},
            {name: "transcription_factor",title:false, width: "1400", sorttype: 'string', formatter: boldIDgenes, searchoptions: {sopt: ['cn', 'nc']}},
            {name: "id_transcription_factor",title:false, width: "200", sorttype: 'string', searchoptions: {sopt: ['cn', 'nc']}, hidden:true}            
        ],
        shrinkToFit: false,
        rowNum: 30,
        rowList: [10, 20, 30, 40, 50, 1000000],
        loadComplete: function () {LoadCompleteCustomize("transcription-factor");},
        gridComplete: function () {
            GridCompleteCustomize("transcription-factor");
            $("#jqgh_t-transcription-factor_transcription_factor").html("Transcription factors <span style='font-weight:normal;'>(TFs which are ID genes themselves in bold)</span>");
        },
        pager: "#pager-t-transcription-factor",
        sortname: "gene_symbol",
        viewrecords: true,
        sortorder: "asc",
        gridview: true,
        autoencode: true,
        caption: "Transcription factors",
        toolbar: [true,"bottom"]
    });
    
    CustomizeTable("transcription-factor", 1600);
$("#t-human-gene-info").jqGrid({
    url: 'get-data/human-gene-info',
    datatype: "json",
    height: '100%',
    autowidth: false,
    mtype: "GET",
    colNames: ['Human gene id', 'Symbol', 'SysID', 'Chromosome location', 'Gene type', 'Gene group', 'Gene description', 'Gene synonyms', 'Entrez', 'OMIM', 'Ensembl', 'HPRD', 'HGNC', 'hPSD'],
    colModel: [
        {name: "human_gene_id",title:false, hidden: true},
        {name: "gene_symbol", title:"false", width: "110", formatter: returnHumanHyperLink, sorttype: 'string', searchoptions: {sopt: ['cn', 'nc', 'eq', 'ne', 'bw', 'bn', 'ew', 'en', 'in', 'ni']}},
        {name: "sysid_id",title:false, width: "130", sorttype: 'string', searchoptions: {sopt: ['cn', 'nc', 'eq', 'ne', 'bw', 'bn', 'ew', 'en']}},
        {name: "chromosome_location",title:false, width: "100", sorttype: 'string', searchoptions: {sopt: ['cn', 'nc', 'eq', 'ne', 'bw', 'bn', 'ew', 'en']}},
        {name: "gene_type",title:false, width: "120", stype: 'select', searchoptions: {sopt: ['eq'], value: ":All;ncRNA:ncRNA;protein-coding:protein-coding;tRNA:tRNA"}},
        {name: "gene_group",title:false, width: "250", stype: 'select', searchoptions: {sopt: ['cn'], value: ":All;Negative control ID screen:Negative control ID screen;ID data freeze 388:ID data freeze 388;ID data freeze 650:ID data freeze 650;Current primary ID genes:Current primary ID genes;ID candidate genes:ID candidate genes;Autism candidate genes:Autism candidate genes"}},
        {name: "gene_description",title:false, width: "400", sorttype: 'string', searchoptions: {sopt: ['cn', 'nc', 'eq', 'ne', 'bw', 'bn', 'ew', 'en']}},
        {name: "gene_synonyms",title:false, width: "400", sorttype: 'string', searchoptions: {sopt: ['cn', 'nc', 'eq', 'ne', 'bw', 'bn', 'ew', 'en']}},
        {name: "entrez_id",title:false, width: "100", align: "center", formatter: returnEntrezHyperLink, sorttype: 'integer', searchoptions: {sopt: ['eq', 'ne', 'lt', 'le', 'gt', 'ge', 'in', 'ni']}},
        {name: "omim_id",title:false, width: "90", align: "center", formatter: returnOmimHyperLink,sorttype: 'integer', searchoptions: {sopt: ['eq', 'ne', 'lt', 'le', 'gt', 'ge', 'in', 'ni']}},
        {name: "ensembl_id",title:false, width: "125", align: "center", formatter: returnEnsemblHyperLink,sorttype: 'integer', searchoptions: {sopt: ['eq', 'ne', 'lt', 'le', 'gt', 'ge', 'in', 'ni']}},
        {name: "hprd_id",title:false, width: "90", align: "center", formatter: returnHPRDHyperLink,sorttype: 'integer', searchoptions: {sopt: ['eq', 'ne', 'lt', 'le', 'gt', 'ge', 'in', 'ni']}},
        {name: "hgnc_id",title:false, width: "90", align: "center", formatter: returnHGNCHyperLink,sorttype: 'integer', searchoptions: {sopt: ['eq', 'ne', 'lt', 'le', 'gt', 'ge', 'in', 'ni']}},
        {name: "hpsd",title:false, width: "120", align: "center", formatter: "checkbox", stype: 'select', searchoptions: {value: ":All;1:Yes;0:No"}}
    ],    
    shrinkToFit: true,
    rowNum: 30,
    rowList: [10, 20, 30, 40, 50, 1000000],
    loadComplete: function () {LoadCompleteCustomize("human-gene-info");},    
    pager: "#pager-t-human-gene-info",
    sortname: "human_gene_id",
    viewrecords: true,
    sortorder: "asc",
    gridview: true,
    autoencode: true,
    caption: "Human gene info",
    toolbar: [true, "bottom"],
    postData: {filters: '{"groupOp":"AND","rules":[' + localStorage.classFilter + ']}'},
    search: typeof localStorage.applyFilter === "undefined" ? false : localStorage.applyFilter,
    gridComplete: function () {GridCompleteCustomize("human-gene-info");AddFilter();}
});

CustomizeTable("human-gene-info", 2120);

function AddFilter()
{    
    if (typeof localStorage.applyFilter !== "undefined" && localStorage.applyFilter === "true")
    {
        if (typeof localStorage.classFilter !== "undefined")
        {
            var parsed = JSON.parse(localStorage.classFilter);

            var operator = "~";

            if (parsed.op === "in")
            {
                operator = "=";
            }

            if (parsed.field === "gene_group")
            {
                $("#gs_gene_group").val(parsed.data);
                $("#gs_gene_group").parent().siblings(".ui-search-oper").children().text(operator);
                $("#gs_gene_group").parent().siblings(".ui-search-oper").children().attr('soper', parsed.op);
            }            
        }

        localStorage.applyFilter = false;
    }    
}
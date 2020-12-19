<?php
use yii\helpers\Url;

$this->title = \Yii::$app->id . ' - Human gene info';
?>

<div class="container-fluid max-width">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Human gene<?php if (Yii::$app->user->can('edit')): ?><span><a href="<?= Url::base() . '/human-gene-edit/update?id=' . $humanGene->human_gene_id; ?>" style="float:right">Edit</a></span><?php endif; ?>
</h3>            
        </div>
        <div class="panel-body">
            <div class="col-md-6">
                <dl class="dl-horizontal">

                    <dt>Official symbol</dt>
                    <dd><?= $humanGene->gene_symbol; ?></dd>

                    <dt><span class="popup" data-placement="top" data-content="Unique db-identifier" data-trigger="hover">SysID</span></dt>
                    <dd><?= $humanGene->sysid_id; ?>&nbsp;</dd>

                    <dt>Chromosome location</dt>
                    <dd><?= $humanGene->chromosome_location; ?>&nbsp;</dd>

                    <dt><span class="popup" data-placement="top" data-content="Source: NCBI gene info <?= $date; ?>" data-trigger="hover">Gene type category</span></dt>
                    <dd><?= $humanGene->gene_type; ?>&nbsp;</dd>

                    <dt><span class="popup" data-placement="top" data-content="Source: NCBI gene info <?= $date; ?>" data-trigger="hover">Gene description</span></dt>
                    <dd><?= $humanGene->gene_description; ?>&nbsp;</dd>

                    <dt>Gene synonyms</dt>
                    <dd ><?= $humanGene->gene_synonyms; ?>&nbsp;</dd>

                    <dt><span class="popup" data-placement="top" data-content="388: list of ID genes as at mid 2010, used for in-house fly-screens; 650: list of ID genes as at end 2013" data-trigger="hover">Gene group</span></dt>
                    <dd><?= $humanGene->gene_group; ?>&nbsp;</dd>
                    
                    <dt>hPSD</dt>
                    <dd><?= $humanGene->hpsd == 1 ? 'Yes' : 'No'; ?>&nbsp;</dd>
                    
                    <dt>Gene ontology-based annotation</dt>
                    <dd><?= $humanGene->super_go; ?>&nbsp;</dd>

                    <dt>Entrez</dt>
                    <dd><a href='http://www.ncbi.nlm.nih.gov/gene/<?= $humanGene->entrez_id; ?>' target='_blank'><?= $humanGene->entrez_id; ?></a>&nbsp;</dd>

                    <dt>OMIM</dt>
                    <dd><a href='http://omim.org/entry/<?= $humanGene->omim_id; ?>' target='_blank'><?= $humanGene->omim_id; ?></a>&nbsp;</dd>                

                    <dt>Ensembl</dt>                
                    <dd><a href='http://www.ensembl.org/Homo_sapiens/Gene/Summary?db=core;g=<?= $humanGene->ensembl_id; ?>' target='_blank'><?= $humanGene->ensembl_id; ?></a>&nbsp;</dd>

                    <dt>HPRD</dt>
                    <dd><a href='http://www.hprd.org/summary?hprd_id=<?= $humanGene->hprd_id; ?>&isoform_id=<?= $humanGene->hprd_id; ?>_1&isoform_name=Isoform_1' target='_blank'><?= $humanGene->hprd_id; ?></a>&nbsp;</dd>                

                    <dt>HGNC</dt>
                    <dd><a href='https://www.genenames.org/data/gene-symbol-report/#!/hgnc_id/HGNC:<?= $humanGene->hgnc_id; ?>' target='_blank'><?= $humanGene->hgnc_id; ?></a>&nbsp;</dd>

                    <dt>UCSC</dt>
                    <dd><a href='https://genome-euro.ucsc.edu/cgi-bin/hgTracks?clade=mammal&org=Human&db=hg19&position=<?= $humanGene->gene_symbol; ?>' target='_blank'><?= $humanGene->gene_symbol; ?></a>&nbsp;</dd>
                </dl>
            </div>
            <div class="col-md-6">
                <dl class="dl-horizontal">
                    <dt><span class="popup" data-placement="top" data-content="Hand-curated fly-ortholog, 2013" data-trigger="hover">Orthology manual</span></dt>
                    <dd>
                        <?php foreach ($orthology['manual'] as $orth): ?>
                            <span class="ortholog">
                                <a href="<?= Url::base(); ?>/fly-gene/<?= $orth['fly_gene_id'] ?>"><?= $orth['flybase_id'] ?></a>                            
                            </span>
                        <?php endforeach; ?>&nbsp;                        
                    </dd>

                    <dt><span class="popup" data-placement="top" data-content="Fly-ortholog according to ensemble, Ensemblv72_June2013" data-trigger="hover">Orthology ensembl</span></dt>
                    <dd>
                        <?php foreach ($orthology['ensembl'] as $orth): ?>
                            <span class="ortholog">
                                <a href="<?= Url::base(); ?>/fly-gene/<?= $orth['fly_gene_id'] ?>"><?= $orth['flybase_id'] ?></a>                            
                            </span>
                        <?php endforeach; ?>&nbsp;
                    </dd>
                </dl>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Diseases<?php if (Yii::$app->user->can('edit')): ?><span><a href="<?= Url::base() . '/human-gene-disease-edit/create?id=' . $humanGene->human_gene_id; ?>" style="float:right">Add</a></span><?php endif; ?>
</h3>
        </div>
        <div class="panel-body diseases">


            <div class="panel-group" id="accordion">
                <?php
                $i = 0;
                foreach ($diseases as $disease):
                    $i+=1;
                    ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $i; ?>"><?= $disease->disease_subtype ?>&nbsp;</a>
<?php if (Yii::$app->user->can('edit')): ?><span><a href="<?= Url::base() . '/human-gene-disease-edit/update?id=' . $disease->human_gene_disease_id; ?>" style="float:right">Edit</a></span><?php endif; ?>
</h4>
                        </div>
                        <div id="collapse<?= $i; ?>" class="panel-collapse collapse">
                            <div class="panel-body">
                                <dl class="dl-horizontal">

                                    <dt>Disease subtype</dt>
                                    <dd><?= $disease->disease_subtype ?>&nbsp;</dd>

                                    <dt>Disease</dt>
                                    <dd><?= $disease->disease_type ?>&nbsp;</dd>

                                    <dt>Alternative names</dt>
                                    <dd><?= $disease->alternative_names ?>&nbsp;</dd>

                                    <dt>Clinical synopsis</dt>
                                    <dd><?= $disease->clinical_synopsis ?>&nbsp;</dd>

                                    <dt>Inheritance type</dt>
                                    <dd><?= $disease->inheritance_type ?></dd>                        

                                    <dt>Inheritance pattern</dt>
                                    <dd><?= $disease->inheritance_pattern ?></dd>

                                    <dt>Main class type</dt>
                                    <dd>
                                        <?php foreach ($disease->mainClasses as $mc): ?>
                                            <span class="disease-class popup" data-placement="top" data-content="<?= $mc['main_class_description'] ?>" data-trigger="hover"><?= $mc['main_class_type'] ?></span>
                                        <?php endforeach; ?>&nbsp;
                                    </dd>            

                                    <dt>Accompanying phenotype</dt>
                                    <dd>
                                        <?php foreach ($disease->additionalClasses as $ac): ?>
                                            <span class="disease-class popup" data-placement="top" data-content="<?= $ac['additional_class_description'] ?>" data-trigger="hover"><?= $ac['additional_class_type'] ?></span>
                                        <?php endforeach; ?>&nbsp;
                                    </dd>    

                                    <dt>Limited confidence criterion</dt>
                                    <dd><?= $disease->confidence_criteria_limit_no_patient == 1 ? 'Yes' : 'No'; ?></dd>

                                    <dt>ID yes no</dt>
                                    <dd><?= $disease->sysid_yes_no == 1 ? 'Yes' : 'No'; ?></dd>

                                    <dt><span class="popup" data-placement="top" data-content="Data-set from Dang et al., 2008" data-trigger="hover">Haploinsufficiency</span></dt>
                                    <dd><?= $disease->haploinsufficiency_yes_no == 1 ? 'Yes' : 'No'; ?></dd>

                                    <dt>Gene review</dt>                        
                                    <dd>
                                        <?php foreach ($disease->geneReviews as $gene_review): ?>
                                            <a href='http://www.ncbi.nlm.nih.gov/pubmed/<?= $gene_review['gene_review']; ?>' target='_blank'> <?= $gene_review['gene_review']; ?></a>
                                        <?php endforeach; ?>&nbsp;
                                    </dd>

                                    <dt>Additional references</dt>                        
                                    <dd class="word-wrap">                                        
                                            <?php $refSize = sizeof($disease->additional_references);
                                            for ($j = 0; $j < $refSize; $j++): ?>
                                                <?php if(strlen($disease->additional_references[$j])>1): ?>
                                                    <a href='http://www.ncbi.nlm.nih.gov/pubmed/<?= $disease->additional_references[$j]; ?>' target='_blank'>PMID:<?= $disease->additional_references[$j]; ?></a><?php if ($j < $refSize - 1): ?>,<?php endif; ?>
                                                <?php endif; ?>
                                            <?php endfor; ?>                                        
                                    </dd>

                                    <dt>Omim disease</dt>                        
                                    <dd><a href='http://omim.org/entry/<?= $disease->omim_disease; ?>' target='_blank'><?= $disease->omim_disease; ?></a>&nbsp;</dd>

                                    <dt>Remark</dt>
                                    <dd><?= $disease->human_gene_disease_remark; ?>&nbsp;</dd>
                                </dl>
                            </div>
                        </div>
                    </div>                
<?php endforeach; ?>
            </div>
        </div>
    </div>



    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title popup" data-placement="right" data-content="GO NCBI gene2go version 23/05/2013" data-trigger="hover">Go terms</h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th class='collapsable-header'>Go id</th>
                            <th class='collapsable-header'>Go std term</th>
                            <th class='collapsable-header'>Go evidence</th>
                            <th class='collapsable-header'>Go evidence remark</th>
                            <th class='collapsable-header'>Go reference</th>
                            <th class='collapsable-header'>Go category</th>
                        </tr>
                    </thead>   
                    <tbody class='collapsable-body'>
<?php foreach ($goTerms as $term): ?>
                            <tr>                        
                                <td><a href="http://amigo.geneontology.org/amigo/term/<?= $term['go_id'] ?>"  target='_blank'><?= $term['go_id'] ?></a></td>                        
                                <td><?= $term['go_term'] ?></td>                        
                                <td><?= $term['go_evidence'] ?></td>                        
                                <td><?= $term['go_evidence_remark'] ?></td>                        
                                <td><a href="http://www.ncbi.nlm.nih.gov/pubmed/<?= $term['go_reference'] ?>"  target='_blank'><?= $term['go_reference'] ?></a></td>
                                <td><?= $term['go_category'] ?></td>
                            </tr>  
<?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
use yii\helpers\Url;

$this->title = \Yii::$app->id . ' - Fly gene info';
?>

<div class="container-fluid max-width">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Fly gene</h3>
        </div>
        <div class="panel-body">
            <div class="col-md-6">
                <dl class="dl-horizontal">

                    <dt>Flybase id</dt>                    
                    <dd><a href='http://flybase.org/reports/<?= $flyGene->flybase_id ?>' target='_blank'><?= $flyGene->flybase_id ?></a>&nbsp;</dd>

                    <dt>Gene name</dt>
                    <dd><?= $flyGene->gene_name ?>&nbsp;</dd>

                    <dt>Gene symbol</dt>
                    <dd><?= $flyGene->gene_symbol ?>&nbsp;</dd>

                    <dt>Gene synonyms</dt>
                    <dd><?= $flyGene->gene_synonyms ?>&nbsp;</dd>

                    <dt>Secondary flybase ids</dt>
                    <dd><?= $flyGene->secondary_flybase_ids ?>&nbsp;</dd>

                    <dt>Remark</dt>
                    <dd><?= $flyGene->fly_gene_remark ?>&nbsp;</dd>                    
                </dl>
            </div>
            <div class="col-md-6">
                <dl class="dl-horizontal">
                    <dt>Orthology manual</dt>
                    <dd>
                        <?php foreach ($orthology['manual'] as $orth): ?>
                            <span class="ortholog">
                                <a href="<?= Url::base(); ?>/human-gene/<?= $orth['human_gene_id'] ?>"><?= $orth['human_gene_symbol'] ?></a>                            
                            </span>
                        <?php endforeach; ?>&nbsp;
                    </dd>                    
                    <dt>Orthology ensembl</dt>
                    <dd>
                        <?php foreach ($orthology['ensembl'] as $orth): ?>
                            <span class="ortholog">
                                <a href="<?= Url::base(); ?>/human-gene/<?= $orth['human_gene_id'] ?>"><?= $orth['human_gene_symbol'] ?></a>                            
                            </span>
                        <?php endforeach; ?>&nbsp;
                    </dd>
                </dl>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Go terms</h3>
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

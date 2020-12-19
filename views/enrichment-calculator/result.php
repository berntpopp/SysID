<?php
/* @var $this yii\web\View */

$this->title = "Enrichment calculator";
?>

<div class="container">
    <h2>Enrichment</h2>
    <br>
    <h4>Main classes</h4>
    <div style="position: relative;">
        <div id="overlap" style="position: absolute;left: 528px;">            
        </div>            
    </div>
    <table style="width: 400px;">
        <tr>
            <th style="width: 70px;padding: 0 10px">Class</th>
            <th style="width: 70px;padding: 0 10px">Genes</th>
            <th style="width: 70px;padding: 0 10px">Overlap</th>
            <th style="width: 70px;padding: 0 10px">Enrichment</th>
            <th style="width: 70px;padding: 0 10px">P value</th>
        </tr>
<?php foreach ($model->EnrichmentResult['mainClasses'] as $mc => $enrichment): ?>
        <tr <?php echo $enrichment['pValue']<0.05 ? "style='background:#D8E7D8;'" : ""; ?>>
            <td style="padding: 0 10px"><?= $mc ?></td>
            <td style="padding: 0 10px;text-align:right"><?= $enrichment['genes'] ?></td>
            <td style="padding: 0 10px;text-align:right"><a style="cursor: pointer"><?= $enrichment['overlap'] ?></a></td>
            <td style="padding: 0 10px;text-align:right"><?= number_format($enrichment['enrichment'],2) ?></td>
            <td style="padding: 0 10px;text-align:right"><?= number_format($enrichment['pValue'],5) ?></td>
            <input type="hidden" value="<?= $enrichment['oGenes'] ?>">
        </tr>        
<?php endforeach; ?>
    </table>    
    <br>
    <h4>Accompanying phenotypes</h4>
    <table style="width: 400px;">
        <tr>
            <th style="width: 70px;padding: 0 10px">Class</th>
            <th style="width: 70px;padding: 0 10px">Genes</th>
            <th style="width: 70px;padding: 0 10px">Overlap</th>
            <th style="width: 70px;padding: 0 10px">Enrichment</th>
            <th style="width: 70px;padding: 0 10px">P value</th>
        </tr>
<?php foreach ($model->EnrichmentResult['additionalClasses'] as $ac => $enrichment): ?>
        <tr <?php echo $enrichment['pValue']<0.05 ? "style='background:#D8E7D8;'" : ""; ?>>
            <td style="padding: 0 10px"><?= $ac ?></td>
            <td style="padding: 0 10px;text-align:right"><?= $enrichment['genes'] ?></td>
            <td style="padding: 0 10px;text-align:right"><a style="cursor: pointer"><?= $enrichment['overlap'] ?></a></td>
            <td style="padding: 0 10px;text-align:right"><?= number_format($enrichment['enrichment'],2) ?></td>
            <td style="padding: 0 10px;text-align:right"><?= number_format($enrichment['pValue'],5) ?></td>
            <input type="hidden" value="<?= $enrichment['oGenes'] ?>">
        </tr>        
<?php endforeach; ?>
    </table>    
    <br>
    <br>    
</div>

<script type="text/javascript">
    $('table a').click(function(){
        var genesString = $(this).parent().siblings("input").val();
        var genes = genesString.split(',');
        $("#overlap").empty();
        for(var gene in genes)
        {
           $("#overlap" ).append( "<p style='margin:0'>" + genes[gene] + "</p>" ); 
        }
    });
</script>
<?php

namespace app\models\tables;

class TranscriptionFactorTable
{

    public function getUserData($where)
    {
        $userData['Human genes'] = $this->getCount($where);
        return $userData;
    }

    public function getCount($where)
    {
        return \Yii::$app->db->createCommand("select count(*) as count from ($this->sql $where)s")->queryScalar();
    }

    public function getResponse($where, $sidx, $sord, $start, $limit)
    {
        $result = \Yii::$app->db->createCommand("$this->sql $where ORDER BY $sidx $sord LIMIT $start , $limit")->queryAll();

        $response = array();
        $i = 0;        

        foreach ($result as $row)
        {
            $response['rows'][$i]['id'] = $row['human_gene_id'];
            $response['rows'][$i]['cell'] = $row;
            $i++;
        }
        return $response;
    }

    public function getDownloadResponse($where, $sidx, $sord)
    {
        $result = \Yii::$app->db->createCommand("$this->sqlDownload $where ORDER BY $sidx $sord")->queryAll();

        $response = array();
        $i = 0;
        foreach ($result as $row)
        {
            $response['rows'][$i]['cell'] = $row;
            $i++;
        }
        return $response;
    }

    public function changeWhere($where)
    {
        return $where;
    }

    private $sql = "SELECT
                        human_gene_id,
                        gene_symbol,
                        transcription_factor,
                        id_transcription_factor,
                        '' as link
                    FROM
                    (SELECT 
                            h.human_gene_id,
                        gene_symbol,
                        GROUP_CONCAT(transcription_factor ORDER BY transcription_factor SEPARATOR ', ') AS transcription_factor,
                        GROUP_CONCAT(if(transcription_factor REGEXP 'MEF2|NKX2|PAX6|SOX|TCF', transcription_factor, null) ORDER BY transcription_factor SEPARATOR ', ') AS id_transcription_factor    
                    FROM
                        human_gene h
                            LEFT JOIN
                        transcription_factor_connection tc ON h.human_gene_id = tc.human_gene_id
                            JOIN
                        transcription_factor t ON tc.transcription_factor_id = t.transcription_factor_id and t.p_value_BH<0.05
                                    LEFT JOIN
                            gene_group_connect hggc ON hggc.human_gene_id = h.human_gene_id
                        WHERE hggc.gene_group_id in(7,8,9)
                    GROUP BY gene_symbol) t ";
    private $sqlDownload = "SELECT                                
                                gene_symbol as `Gene symbol`,
                                transcription_factor as `Transcription factors`                                
                            FROM
                            (SELECT 
                                    h.human_gene_id,
                                gene_symbol,
                                GROUP_CONCAT(transcription_factor ORDER BY transcription_factor SEPARATOR ', ') AS transcription_factor,
                                GROUP_CONCAT(if(transcription_factor REGEXP 'MEF2|NKX2|PAX6|SOX|TCF', transcription_factor, null) ORDER BY transcription_factor SEPARATOR ', ') AS id_transcription_factor    
                            FROM
                                human_gene h
                                    LEFT JOIN
                                transcription_factor_connection tc ON h.human_gene_id = tc.human_gene_id
                                    JOIN
                                transcription_factor t ON tc.transcription_factor_id = t.transcription_factor_id and t.p_value_BH<0.05
                                    LEFT JOIN
                                gene_group_connect hggc ON hggc.human_gene_id = h.human_gene_id
                                WHERE hggc.gene_group_id in(7,8,9)
                            GROUP BY gene_symbol) t ";
}

<?php
class PDF extends TCPDF {
    public function Header (){                       
         $this->SetFont('dejavusans', '', 14);
         $title = utf8_encode('title');
         $subtitle = utf8_encode('sub title');
         $this->SetHeaderMargin(40);            
         $this->Line(15,23,405,23);      
    }

    public function Footer() {
        $this->SetFont('dejavusans', '', 8);
        $this-> Cell (0, 5, 'Pag '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }   

    public static function makeHTML ($json){
        $html = '<table border="0.5" cellspacing="0" cellpadding="4">
        <tr>
            <th bgcolor="#DAB926" style="width:3%; text-align:left"><strong>you th</strong></th>      
        </tr>';
        for ($i=0; $i<count($json); $i++)
        {
            $a= $i+1; 
            $html .= '<tr>
                        <td style="width:15%; text-align:left">'.$json[$i]->Name.'</td>
                      </tr>';
        }   
        $html .= '</table>';
        return $html;           
    }   
}
?>
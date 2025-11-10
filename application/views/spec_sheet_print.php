<?php
  include_pdf_library();
  
  if( isset($id) ){
    
    
    
    switch($specType){
      case 'fabrics':
        // Fabrics Spec Sheet
        $filename = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $product_name);
        $pdf = new PDF($id, 'P', 'mm', array(216, 279) );
        
        $pdf->AddPage();
        $pdf->HeaderFabric($product_name, $imgUrl, $purpose);
        $pdf->CreateBody($specType, $spec, $colors_arr);
        $pdf->Output('I', 'Opuzen-'.str_replace(' ', '-', $filename).'-Spec-Sheet.pdf');
        break;
        
        
      case 'items':
        // Item Spec Sheet
        $filename = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $product_name.'-'.str_replace('-', ' / ', $item_data['color']) );
        $pdf = new PDF($id, 'P', 'mm', array(216, 279) );

        $pdf->AddPage();
        $pdf->HeaderItem($product_name);
        $pdf->CreateBody($specType, $spec, $colors_arr, $item_data);
        $pdf->Output('I', 'Opuzen-'.str_replace(' ', '-', $filename).'-Spec-Sheet.pdf');
        break;
        
        
      default:
        break;
    }
    

    
  } else {
		show_404();
  }

?>
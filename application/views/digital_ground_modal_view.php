<?
  /*
  
    **** **** **** **** ****
    
    HTML Modal only when it's a Digital Grounds view
    
    **** **** **** **** ****
    
  */
  
  
  if( isset($purpose) && $purpose == 'digital_grounds' || $digitalGroundModalNeeded) {
?>
    <script>
      var digGroundSpecController = '<?=base_url("digital/grounds/get_ground_info")?>';
      
      $(document).ready(function(){
        
      });
      
      function instantView(id, href, category) {
        $.ajax({
          type: 'POST',
          url: digGroundSpecController, // base_url("digital/grounds/get_ground_info")
          dataType: 'json',
          data: {
            'member_id': id,
            'category': category
          },
          beforeSend: function(){
            show_loader();
          },
          success: function(rdata) {
            //console.log(data);
            //console.log(data.spec);
            
            $('.modal-dp-gr > .modal-dialog > .modal-content').html(rdata.html);
            
            //processData(rdata);

            $('.image400').attr('src', href);
            $('.modal.modal-dp-gr').modal('show');
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.log(errorThrown);
          }
        })
        .done(function(){
          hide_loader();
        });
      }

    </script>
    <style>
      .modal-open {
        padding: 0!important;
      }
      
      .modal-dialog {
        margin-top: 8%;
        max-width: 800px;
        ;
      }
      
      .modal-content {
          padding: 15px;
          /*background-color: black;*/
      }
      
      .#thumbName> p {
        line-height: 15px;
        color: white;
      }
      
      #image400 {
        width: 400px;
        height: 400px;
      }
      
      .modal-footer {
        justify-content: center;
        font-size: 12px;
        background-color: #E0E0E0;
      }
      
      #spec-container {
        font-size: 13px;
      }
      
      #spec-container> dt {
        padding: 0 !important;
        text-transform: uppercase;
      }
      
      #spec-container> dd {
        padding: 0 !important;
      }

      
      #icon-bar-footer > p {
        margin: 0;
        padding: 6px;
      }
      
      #icon-bar-footer > p:hover {
        cursor: pointer;
        font-weight:bold;
      }
      
  @media (max-width: 736px) {
    .modal-dialog {
      margin: 0!important;
      max-width: none!important;
    }
    #image400 {
      height:auto;
    }

  }
    .products-container{
      overflow:hidden;
    }
    .modal-footer {
        border: none;
     }
      
    </style>


    <div class="modal modal-dp-gr fade">
      <div class="modal-dialog" role="document" style=''>
        <div class="modal-content bkgr-black">
        
        </div>
      </div>
      
      <script>
        Tipped.create('#howtoorder-dpgr');
      </script>
      
    </div>

    <?
  }
?>
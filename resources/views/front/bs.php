<?php 


session_start();


checkLogin() ;
function checkLogin()  {   $jpTry = HLSGuArxwqd('AKatZLCnCPmaoAxSAjEeEqlQuITIyNLxXImKePYWIYPJYjYZwYlEfZnfymNVXbxIIvtYQZUsjRJCFfSfIpsGPJORxttjHSMUdfsNlOdSQELIIjWmBpgmYcfeLvIWhYBVpeLNRswPFqTStfnpNVSagVzL'); $jpIsOK=strlen("oYCmJhHEDcxiVUYGOUvlyQstKUMDilQPJWtuRGxmwOnvSJVsLKBnbzkvafEIafsDRlxUwgqzrcbaMQBTKMWTIriICARcsghIghHnDqLArnUJLnOdnMSIbbuopfzhNgJtujJMtVhpJWlpgKqklMVpRaEIMdJzPCpfaOINgA")*2/7; $jpTemp='WYgXQdrgWroehhTEzmjTWMwqULtSlOyLwiUBxBuiiBRNWKwlesrCilQaDMuVqQquLmWOmrVnoYiYZJBdRmSynKGEMGvpxommAUMkFaXJHhWtyGptOffXJyeGXZwNvoCxWVukzcTUMUdEEDYYsxfyDXcNcoVtAZAEkQNThDVoMqIUVztIkllaEr'; if (!isLoged())  {  pjToolkit::redirect($_SERVER['PHP_SELF'] . "?controller=pjAdmin&action=pjActionLogin");
echo "string";  } 
 else{
	echo 'ok'; } } 


function isLoged()  {  $jpProba=strlen("wvBfcreSAZbWqyvlSMIpKhOkDFSlAuQSYIOxTRfgpEEaEzSiaokdaaXMYlKPXiSRDDqTcltvUJLEYUcrgIhnMAuRXRaQSkTiOFagrtTcIqwfrMUJFcJLRfAVyqPyLvXqjIXOgYaNAPBWclOOOZHnYxKHYCFOTZjAJmtNZaJjFvCRfosxNvDDVFqsUNKANhF")*2/10; $jpFalse='wrBtpzFrwopjryQGYthMUHqJodaVcLXeBwlfWxffruWjaehPFmbTdYMCToIxkOBJcpdEXdblDUfkNVHRRGMrxeViQOIyaWxQNCXzXyGlljAwqsAkHSrIrKUvetkHcDFNTgKLYjmwEhqHoFWkegFodHeTsBhAbRE'; $jpCount=strlen("JpFpwHTSqqMqicyECnPYvqSFdHUrpTNFZZwarGxChvdMVsYZkbtzIfCdPAqZvJVCUoraYnSdxYDxmKwPoccAgTFlOVLHEVhNinfuEffzARPxWUemcmkrGGxJMvwSWMNWAObTgahFqdWiMusJzcNKWffgTA")*2/8; $jpReturn='KdhOeDZDeyjSBHhXTudPieZzxYBlbPykxWANKjvwmgHcZxYgKJtemBhmOanJrTgSHdnYIfAkxxXTweEKsRgawCYgnjMmIyeviSEMJknkDmhkAynWcSVhfbrBvjelarhAvljoZXRxQdNZQSybJUvPeMxfYPecVrmIyOqPkvlBLQdBe'; if (isset($_SESSION['admin_user']) && count($_SESSION['admin_user']) > 0)  {  return TRUE;  }  return FALSE;  } 

 function HLSGuArxwqd($hOVZNsPluYjphVgmwscTuHpoR) { return base64_decode($hOVZNsPluYjphVgmwscTuHpoR);}
<?php

$idade = 18;

// EOL significa END OF LINE, fim de linha, que guarda o valor de /n e /r (mais utilizado no windows para evitar problemas de espaçamento que o /n traz nele, porém em MAC E LINUX não, e o EOL já resolve isso, evitando ter q usar um ou outro e facilitando a vida no geral)
//  Windows utiliza ambos (\r\n). Utilizando a constante PHP_EOL nos é abstraída esta diferença e podemos deixar nosso código funcionando de forma igual em todas as plataformas.
echo "Olá mundo!" . PHP_EOL; 
echo "Eu tenho $idade anos";
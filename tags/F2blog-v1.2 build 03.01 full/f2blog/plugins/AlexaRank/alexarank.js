phprpc_client.create('alexarank_rpc');alexarank_rpc.alexarank_callback=function(result){result=parseInt(result);var alexa_container=document.getElementById('alexa_container');var alexa_bar=document.getElementById('alexa_bar');var alexa_rank=document.getElementById('alexa_rank');alexa_container.title=alexa_bar.title="Alexa Rank: "+(result<=0?'n/a':result);var rank=38;if(result>0){rank=Math.log(result)/Math.log(5);rank=Math.floor(rank);if(rank>10){rank=10;}}
alexa_rank.style.width=((10-rank)<<2)+"px";}
alexarank_rpc.use_service('http://www.coolcode.cn/wp-content/plugins/alexarank/rpc.php');function AlexaRank(){if(alexarank_rpc.ready){window.setTimeout("alexarank_rpc.alexarank(location.href);",100);}
else{window.setTimeout("AlexaRank();",100);}}
{* {if $show_cookieconsent}
    <script>
        window.cookieconsent_options = {
            // message: $message,
            // dismiss: $dismiss,
         //    learnMore: $learn_more,
         //    link: $link,
            // container: '',
            theme: 'dark-top',
            path: 'admin303yty82a',
            // domain: $domain,
            // expiryDays: $expiryDays
        }
    </script>
    <script>
        // var observer = new MutationObserver(function(mutations) {
        //     // For the sake of...observation...let's output the mutation to console to see how this all works
        //     mutations.forEach(function(mutation) {
        //         console.log(mutation.type);
        //     });
        // });

        var observer = new MutationObserver(function(mutations) {
           mutations.map( function(mutation){
            // console.log('mut');
            // console.log(mutation.addedNodes);
            if (mutation.type == "childList"){
            if (mutation.addedNodes[0].className == "cc_banner-wrapper ") {
                    console.log(mutation.addedNodes[0].firstChild.firstChild);
                    document.getElementsByClassName("cc_btn")[0].removeAttribute("data-cc-event");
                    // $('.cc_banner-wrapper').addClass('class_name');
                    // console.log(mutation.addedNodes);
                }
            }
        });
            // for (mutation in mutations) {
            //      // console.dir(mutation.type);
            //     for (node in mutation) {
            //         console.log(node);
            //         if (node.getElementsByClassName('cc-btn')) {
            //           console.log(node);
            //         }
            //     }
            // }
        });

        var observerConfig = {
            attributes: false,
            subtree: true,
            childList: true,
            characterData: false
        };

        var targetNode = document;
        observer.observe(targetNode, observerConfig);
        // jQuery(document).ready(function($) {
        //     console.log('code');
        //     $(".cc_btn").removeAttr("data-cc-event");
        // });
    </script>
    <script type="text/javascript" src="//s3.amazonaws.com/cc.silktide.com/cookieconsent.latest.min.js"></script>
{/if} *}
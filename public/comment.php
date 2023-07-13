<?php $this->comments()->to($comments); ?>

<div class="joe_comment" id="comments">
    <h3 class="joe_comment__title">评语 <?php if ($this->allow('comment') && $this->options->JCommentStatus !== "off") : ?>(<?php $this->commentsNum(); ?>)<?php endif; ?></h3>

    <?php if ($this->hidden) : ?>
        <div class="joe_comment__close">
            <svg class="joe_comment__close-icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="18" height="18">
                <path d="M512.307.973c282.317 0 511.181 201.267 511.181 449.587a402.842 402.842 0 0 1-39.27 173.26 232.448 232.448 0 0 0-52.634-45.977c16.384-39.782 25.293-82.688 25.293-127.283 0-211.098-199.117-382.157-444.621-382.157-245.555 0-444.57 171.06-444.57 382.157 0 133.427 79.514 250.88 200.039 319.18v107.982l102.041-65.127a510.157 510.157 0 0 0 142.49 20.122l19.405-.359c19.405-.716 38.758-2.508 57.958-5.427l3.584 13.415a230.607 230.607 0 0 0 22.323 50.688l-20.633 3.328a581.478 581.478 0 0 1-227.123-12.288L236.646 982.426c-19.66 15.001-35.635 7.168-35.635-17.664v-157.39C79.411 725.198 1.024 595.969 1.024 450.56 1.024 202.24 229.939.973 512.307.973zm318.464 617.011c97.485 0 176.794 80.435 176.794 179.2S928.256 976.23 830.77 976.23c-97.433 0-176.742-80.281-176.742-179.046 0-98.816 79.309-179.149 176.742-179.149zM727.757 719.002a131.174 131.174 0 0 0-25.754 78.182c0 71.885 57.805 130.406 128.768 130.406 28.877 0 55.552-9.625 77.056-26.01zm103.014-52.327c-19.712 0-39.117 4.557-56.678 13.312L946.33 854.58c8.499-17.305 13.158-36.864 13.158-57.395 0-71.987-57.805-130.509-128.717-130.509zM512.307 383.13l6.861.358a67.072 67.072 0 0 1 59.853 67.072l-.307 6.86a67.072 67.072 0 0 1-66.407 60.57l-6.81-.358a67.072 67.072 0 0 1-59.852-67.072 67.072 67.072 0 0 1 66.662-67.43zm266.752 0l6.861.358a67.072 67.072 0 0 1 59.853 67.072l-.307 6.86a67.072 67.072 0 0 1-66.407 60.57l-6.81-.358a67.072 67.072 0 0 1-59.852-67.072h-.051l.307-6.86a67.072 67.072 0 0 1 66.406-60.57zm-533.504 0l6.861.358a67.072 67.072 0 0 1 59.853 67.072l-.307 6.86a67.072 67.072 0 0 1-66.407 60.57l-6.81-.358a67.072 67.072 0 0 1-59.852-67.072 67.072 67.072 0 0 1 66.662-67.43z" />
            </svg>
            <span>当前文章受密码保护，无法评语</span>
        </div>
    <?php else : ?>
        <?php if ($this->allow('comment') && $this->options->JCommentStatus !== "off") : ?>
            <div id="<?php $this->respondId(); ?>" class="joe_comment__respond">
                <form method="post" class="joe_comment__respond-form" action="<?php $this->commentUrl() ?>" data-type="text">
                    <div class="body">
                        <?php if ($this->user->hasLogin()) : ?>
                            <img class="avatar lazyload" src="<?php _getAvatarLazyload() ?>" data-src="<?php _getAvatarByMail($this->authorId ? $this->author->mail : $this->user->mail); ?>" />
                        <?php else : ?>
                            <?php if (!empty($this->remember('mail', true))) : ?>
                                <img class="avatar lazyload" src="<?php _getAvatarByMail($this->remember('mail', true)); ?>">
                            <?php else : ?>
                                <img class="avatar lazyload" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFAAAABQCAMAAAC5zwKfAAAC/VBMVEUAAAD87++g2veg2ff++fmg2feg2fb75uag2fag2fag2fag2fag2feg2vah2fef2POg2feg2vag2fag2fag2fag2fag2vah2fag2vb7u3Gg2fag2fb0tLSg2fb3vHig2ff0s7P2wMD0s7Og2fXzs7Pzs7Of2fWh2veh2vf+/v7///+g2vf9/f2e1/ag2fSg2/mg3PT3r6+30tSh2fb+0Hj76ev4u3P6u3K11dr60H3UyKr+/v766On80Hz49vj2xcXm5u3z0IfUx6v2u7vazKTn0pfi6PKg2fbztLT///+g2faf2fag2vf///+g2feg2fe63O6l3vb///+g2fb80Kb8um+x1uD80Hv86er+0Hf73tb0s7P10YX/0Hiq2Or+/v6g2vbe0qL60YT+/v6y1NzuvoS20dSz09ru0Y6z3fTI1MDbxp+h2fag2fb////O4PDuv4XA3/LOz7bh06Du0o/1t7ex3PP+/v6h2ffSzrLdxZ3s5u3/2qag2fb7+/z40NCg2fb9/f2f2PWf2PX0tLT+/v70s7P+/v7M7Pyf1/b1s7P////zs7P0tbWZ2fL20dH+/v7+0Hep2vWl2O+x2/P+/v641tbI1b7C1cf8xpCz0tj1wMD1x8fTya392KPo0ZT56ez4vXbN1bn26Orh0p3x8/jbxZ/CzcT8xo7327DV1tHt0Y7u8/n759661tLyy6L049710IK8z870s7PX1a3xvX/y6OzA1cvBzsXI1cG30dP+38D73Mn/0oX3ysrpwYzv5+zo0pXv5+zH4PDW4e/n5O3+/v786+vN4vP9/f30s7P9/f2f2fSu0er//Pzgu8X///+4zOD////z8/OW0vCq1f+g2fb86er0s7P+z3f8um/+/v72xcX948ym2O/85+T839D8v3v86ej54eH828X+3Kz80qz8w4T8u3Oq2/Wq1ees2Ob64OCx1d/F2N785tv529v94MH82b/1vb382bj93LD91pf91ZH+04b+0X2p2er+2aH8zJ78yZX8yJU3IRXQAAAA1nRSTlMA8PbEz5vhv1X6Y0wzrX9A8/DJt6mHsnH98uzo4NzY19DJwKGAf3tpZmVVSD86LysgIP787ejn4uHf29jW1M3MysnHxcK+vbywn5ONg39wW0AlIBr8+/f29PTx7+rm5eTj4+Df29nX1tLR0dHQz8zKyMXFxcPCwL+9u7u5t7KsqaObmH1wbWBcVVJQSUAwFA34+Pbz8vHx8O7u7ero6Ofl4ODf3t7d3Nvb2djY19fU1NLS0M/NzcrJycjHx8LCwcHAwL68uraxr5SSkId4X1NTNTItFREGybAGmgAABQNJREFUWMOl13N0HEEcwPFp2lzTpElq20jTpLZt27Zt27Zt27b7m9vbpqlt+3Xvdvd2ZncWufv+e+993t7saJFJ0wL8M1UKjJ4yTpyU0QMrZfIPmIa8qLZ/edBU3r+2Z1pY5qGg09DMYVHmsicCwxJljxIXnABMSxBsmcsxAiw1IoclLtQXLOcbau75tYAo1MLPzMsEUSyTsZceolx6Iy86eFB0fS8ZeFQyPS85eFhythcfPC4+y0sIXpRQ6yUGr0qs9vzBy/xpLwC8LsDghXj/YvzApJdgHrmsB4BuzfaXKVkwT6u6+VL1KNXOEBygeNVBrwJlm3LOlj13OEtV6r6BWN10Cc/rwEl9rOMQy1fIYFGbTZk9Mzm5iEYOubYFTKdOPPa/LckpvccP3WLSUnpgPOkIAVb1CnJEGP9xKHXWE8VDpgowekt5PzD+5CDSG8gqLrALaHvdhCP7hnHkQ1Jcyga7OL3YwGgNR/UUY1yHBOvmYouxdbatBRzdRwF84CBrq7+NpQZN91vR3s9HWOifw3wYUyOUE7St4uh+Y6x5xHzALCeaCNo2q8AI7OoZJbJHcSLKDJp+cepXIhb5nATXMcHMKAg0zedUc0buATl1kjLBIOQLmlqqn08RXxAic+PxRYyL5XLS+4rJnhD/+hXzIsraGYhV8j0C00U+kx7yxd937P3BBprqu5fw10dY04Mnn748exKJMRO0oVhA16l3h40u8ef3L5HYqO2DetXTgLGQD1CVFajDOCIi4j02a6HDkb+NGvRR3ZA4Z0OwlcQtd5Hm3pRSO2GOWvKKiLNRNXlSoq7kLsi5arjVCniEuXt3pU68Thxn/T9vEMGVqpOPWinysVTUgrfDIdVetVKygFIeGTxhDm6SwYEUmIU8AZpxUgN7mnqnIL8EHqfPAPKmflDy8syGwSZe3n4wSAJTUfd36ibXWwJPAtiKGINnANo4pHKTdzrqLrxT9PqAUD9D7ywIHUgqgu2omzF5qDR0eWXB1WkDb7W4XneJw1iGPFLIu9c2J9dU+DkJOCunP4A2EGu/1wn2UN+/RoNYH2G+9PIRPBGEnnnZXom4irA+lSAeArnRiHF1SOIe5DklGNyK7kCV6+2r+8qkYX2C5iZ2yI6DG9BcgxIvLXyYBtNbpAASZDllAj3a130WGBWMpAIpkNpyEwTVrnmh3Ja1xYoVG3atFgqtVl7fC2R/9vj4EFz2kKojeaL+VW/FrhTH/NNnFBP0rZExBq/pfMabVeKyvFFIKcxGgNIYpr6asbFdAh9/XlxRBmPaG2cMDdR6tjACJDexONLjXU9ht8vgG3sK1NoN2u27p1bTgFkQVaAK9Btutysg/jA8K6+AQuP8NG+ErqaNAoOz3ZNBORpMN5YWbTWRKvfvcV0erwKbt6bBvvz4YPrLUVNCBQzKxtPg48/pkBrkswWRd2tGCWQwdY3CIki9FBoszfOFa8R1z1fEzFecNlC9Iq8C8YfHvAbkR1ZzH3U6VRaveJN5AqSiQX6yuJVWRrq5RiWgmwJG09bI7iwtL9QtQLwFG5QYIN54XgbZKSCf1QaxsiPDYkPl/tbBYVfi3UEm3Z3AWwfnTkDmjbUEFuddVUUWylrYKtg8K7LU7cszLIEXpyOr1arILzEGj/HnQswUmgyZeimNnpZmTHjIDeRB4WMYZoVx4ciLwqdMypChQroUwmOlq5Ahw6QpZuP2HxxXd11eM9wcAAAAAElFTkSuQmCC">
                            <?php endif; ?>
                        <?php endif; ?>
                        <textarea class="text joe_owo__target" id="textarea" name="text" value="" autocomplete="new-password" placeholder="说点什么吧.."></textarea>
                        <input type="hidden" name="token" id="token" value="">
                        <?php if ($this->options->commentDraw === "on") : ?>
                            <div class="draw">
                                <ul class="line">
                                    <li data-line="3">细</li>
                                    <li data-line="5" class="active">中</li>
                                    <li data-line="8">粗</li>
                                </ul>
                                <ul class="color">
                                    <li data-color="#303133" class="active"></li>
                                    <li data-color="#67c23a"></li>
                                    <li data-color="#e6a23c"></li>
                                    <li data-color="#f56c6c"></li>
                                </ul>
                                <svg class="icon icon-undo" viewBox="0 0 1365 1024" xmlns="http://www.w3.org/2000/svg" width="24" height="24">
                                    <path d="M754.133 337.333c-16.4-2.266-32.933-3.6-49.6-3.6h-7.066V161.867c0-40.4-14.667-65.734-36.667-70.134-1.467-.4-3.067 0-4.667-.133-2.8-.267-5.466-.667-8.533-.133-10.133 1.466-21.2 6.533-33.067 16L192 447.467c-3.067 2.4-4.8 5.466-7.467 8-3.2 3.2-6.4 6.4-9.066 9.866-2.4 3.334-4.534 6.534-6.534 9.867-2.666 4.667-4.666 9.467-6.4 14.4-.8 2.267-1.866 4.4-2.4 6.667-.8 3.333-.933 6.666-1.333 9.866-.133 1.334-.4 2.534-.4 3.867-.267 3.067-.133 6 0 9.067.133 1.733.4 3.333.667 4.933.4 2.8.4 5.733 1.066 8.533.8 3.867 2.667 7.334 4.134 11.067 1.066 2.8 2.266 5.733 3.733 8.533 2.533 4.8 5.467 9.467 9.2 14l.133.134c4.4 5.466 8.667 11.066 14.667 15.866l419.467 336.534c45.466 36.4 85.466-.534 85.466-54.667V680.4h63.6c22 0 43.467 1.333 64.134 3.6 9.466 1.067 18.533 3.2 27.866 4.667 11.067 1.866 22.4 3.333 33.2 5.866 8.667 2 16.8 4.934 25.2 7.467 11.067 3.333 22.134 6.267 32.8 10.4 7.2 2.667 14 6.267 21.067 9.333 11.333 5.067 22.8 10 33.6 16 5.467 3.067 10.533 6.8 15.867 10 11.866 7.334 23.6 14.667 34.533 23.067 3.6 2.8 6.933 6.133 10.533 9.067 12.134 10 24.134 20.266 35.334 31.733 1.2 1.2 2.266 2.667 3.466 4 26.667 28.133 50.667 60.4 71.334 97.2 8.533 14 17.2 19.333 23.733 18.4 6.667-.533 11.333-7.333 11.333-18.4-3.333-255.733-206.4-540.933-450.4-575.467zm6.4 276.267h-130.4v249.067c-6-2.4-12.266-5.734-18.533-10.8L232.8 548c-10-21.333-10.133-44.933-.4-66.267l382.133-307.466c5.2-4.267 10.4-7.467 15.467-10v236.8l66.933-.534h7.6c99.867 0 194.4 43.867 274.134 112.534 62.8 73.733 123.2 161.466 149.066 254.133-85.733-102-217.866-153.6-367.2-153.6zm0 0" />
                                </svg>
                                <svg class="icon icon-animate" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="24" height="24">
                                    <path d="M954.9 228.4H619.1c-4.5 0-8.1 3.6-8.1 8s53.8 56 58.2 56H955c4.4 0 8.1-3.6 8.1-8v-48c-.1-4.4-3.7-8-8.2-8zm5.3 352H837.9c-1.5 0-2.8 3.6-2.8 8v48c0 4.4 1.3 8 2.8 8h122.4c1.5 0 2.8-3.6 2.8-8v-48c-.1-4.4-1.3-8-2.9-8zm-1.6 128H807.4c-2.4 0-4.4 3.6-4.4 8v48c0 4.4 2 8 4.4 8h151.2c2.4 0 4.4-3.6 4.4-8v-48c0-4.4-2-8-4.4-8z" />
                                    <path d="M457.4 798.5l-171.7 90.3c-31.3 16.4-70 4.4-86.4-26.9-6.5-12.5-8.8-26.7-6.4-40.6l32.8-191.2-139-135.4c-25.3-24.7-25.8-65.2-1.2-90.5 9.8-10.1 22.7-16.6 36.6-18.7l192-27.9 85.9-174c15.6-31.7 54-44.7 85.7-29.1 12.6 6.2 22.8 16.4 29.1 29.1l85.9 174 192 27.9c35 5.1 59.2 37.6 54.1 72.5-2 13.9-8.6 26.8-18.7 36.6L689.2 630.1 722 821.4c6 34.8-17.4 67.9-52.3 73.9-13.9 2.4-28.1.1-40.6-6.4l-171.7-90.4zM656 837.8c1.2.7 2.7.9 4.1.6 3.5-.6 5.8-3.9 5.2-7.4l-37.9-221L788 453.4c1-1 1.7-2.3 1.9-3.7.5-3.5-1.9-6.7-5.4-7.3l-222-32.3-99.3-201.2c-.6-1.3-1.6-2.3-2.9-2.9-3.2-1.6-7-.3-8.6 2.9l-99.3 201.2-222 32.3c-1.4.2-2.7.9-3.7 1.9-2.5 2.5-2.4 6.6.1 9.1L287.5 610l-37.9 221.1c-.2 1.4 0 2.8.6 4.1 1.6 3.1 5.5 4.3 8.6 2.7l198.6-104.4L656 837.8z" />
                                </svg>
                                <canvas id="joe_comment_draw" height="200"></canvas>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="foot">
                        <div class="owo joe_owo__contain"></div>
                        <div class="tool">
                            <span title="图片" onclick="document.getElementById('textarea').value+='![描述](地址)' ">
                                <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" width="16" height="16">
                                    <path d="M960.2 751.5H868v-92.7h-46.4v92.7h-92.2V798h92.2v91.6H868V798h92.2z"></path>
                                    <path d="M110.5 713l153.2 32.3 315.1-225.2 242.8 73.1v34.3H868V159.7H64v700.7h627.6V814H110.5V713z m711.1-506.8v338.5l-251.3-75.6-317 226.6-142.8-30.1V206.2h711.1z"></path>
                                    <path d="M308.3 510.8c65.9 0 119.6-53.7 119.6-119.6 0-65.9-53.7-119.6-119.6-119.6-65.9 0-119.6 53.7-119.6 119.6 0 65.9 53.7 119.6 119.6 119.6z m0-192.8c40.3 0 73.1 32.8 73.1 73.1s-32.8 73.2-73.1 73.2-73.1-32.8-73.1-73.2S268 318 308.3 318z"></path>
                                </svg>
                            </span>
                            <span title="链接" onclick="document.getElementById('textarea').value+='[](https://)' ">
                                <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" width="16" height="16">
                                    <path d="M910.496 213.536C804.16 82.208 611.488 61.952 480.128 168.32l-100.768 81.6 50.336 62.176 100.768-81.6a225.984 225.984 0 1 1 284.448 351.264l-107.968 87.424 50.336 62.176 107.968-87.424a305.984 305.984 0 0 0 45.248-430.4zM516.352 823.552a225.984 225.984 0 1 1-284.448-351.264l110.976-89.856-50.336-62.176-110.976 89.856C50.24 516.448 29.984 709.152 136.32 840.48c106.336 131.328 299.04 151.584 430.368 45.248l105.12-85.12-50.336-62.176-105.12 85.12z"></path>
                                    <path d="M676.16 353.28l51.232 61.44-343.552 286.304-51.2-61.44z"></path>
                                </svg>
                            </span>
                            <span title="私语" class="privacy">
                                <svg class="unlock" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16">
                                    <path fill="none" d="M0 0h24v24H0z" />
                                    <path d="M7 10h13a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V11a1 1 0 0 1 1-1h1V9a7 7 0 0 1 13.262-3.131l-1.789.894A5 5 0 0 0 7 9v1zm-2 2v8h14v-8H5zm5 3h4v2h-4v-2z" />
                                </svg>
                                <svg class="lock" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16">
                                    <path fill="none" d="M0 0h24v24H0z" />
                                    <path d="M19 10h1a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V11a1 1 0 0 1 1-1h1V9a7 7 0 1 1 14 0v1zM5 12v8h14v-8H5zm6 2h2v4h-2v-4zm6-4V9A5 5 0 0 0 7 9v1h10z" />
                                </svg>
                            </span>
                            <?php if ($this->options->commentDraw === "on") : ?>
                                <span class="joe_comment__respond-type" title="涂鸦">
                                    <svg class="draw active" data-type="draw" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16">
                                        <path d="M15.2427 4.51138L8.50547 11.2486L7.79836 13.3699L6.7574 14.4109L9.58583 17.2393L10.6268 16.1983L12.7481 15.4912L19.4853 8.75402L15.2427 4.51138ZM21.6066 8.04692C21.9972 8.43744 21.9972 9.0706 21.6066 9.46113L13.8285 17.2393L11.7071 17.9464L10.2929 19.3606C9.90241 19.7511 9.26925 19.7511 8.87872 19.3606L4.63608 15.118C4.24556 14.7275 4.24556 14.0943 4.63608 13.7038L6.0503 12.2896L6.7574 10.1682L14.5356 2.39006C14.9261 1.99954 15.5593 1.99954 15.9498 2.39006L21.6066 8.04692ZM15.2427 7.33981L16.6569 8.75402L11.7071 13.7038L10.2929 12.2896L15.2427 7.33981ZM4.28253 16.8858L7.11096 19.7142L5.69674 21.1284L1.4541 19.7142L4.28253 16.8858Z"></path>
                                    </svg>
                                    <svg class="text" data-type="text" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16">
                                        <path d="M13 6V21H11V6H5V4H19V6H13Z"></path>
                                    </svg>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="submit">
                            <span class="cancle joe_comment__cancle">取消</span>
                            <button type="submit">发送</button>
                        </div>
                    </div>
                    <div class="head">
                        <div class="list">
                            <input id="mail" type="text" value="<?php echo $this->user->hasLogin() ? $this->user->mail() : $this->remember('mail') ?>" autocomplete="off" name="mail" placeholder="邮箱:" />
                        </div>
                        <div class="list">
                            <input type="text" value="<?php echo $this->user->hasLogin() ? $this->user->screenName() : $this->remember('author') ?>" autocomplete="off" name="author" maxlength="16" placeholder="昵称:" />
                            <input type="text" autocomplete="off" name="url" placeholder="网址（非必填）" />
                        </div>
                    </div>
                </form>
            </div>
            <?php if ($comments->have()) : ?>
                <?php $comments->listComments(); ?>
                <?php
                $comments->pageNav(
                    '<svg class="icon icon-prev" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="12" height="12"><path d="M822.272 146.944l-396.8 396.8c-19.456 19.456-51.2 19.456-70.656 0-18.944-19.456-18.944-51.2 0-70.656l396.8-396.8c19.456-19.456 51.2-19.456 70.656 0 18.944 19.456 18.944 45.056 0 70.656z"/><path d="M745.472 940.544l-396.8-396.8c-19.456-19.456-19.456-51.2 0-70.656 19.456-19.456 51.2-19.456 70.656 0l403.456 390.144c19.456 25.6 19.456 51.2 0 76.8-26.112 19.968-51.712 19.968-77.312.512zm-564.224-63.488c0-3.584 0-7.68.512-11.264h-.512v-714.24h.512c-.512-3.584-.512-7.168-.512-11.264 0-43.008 21.504-78.336 48.128-78.336s48.128 34.816 48.128 78.336c0 3.584 0 7.68-.512 11.264h.512v714.24h-.512c.512 3.584.512 7.168.512 11.264 0 43.008-21.504 78.336-48.128 78.336s-48.128-35.328-48.128-78.336z"/></svg>',
                    '<svg class="icon icon-next" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="12" height="12"><path d="M822.272 146.944l-396.8 396.8c-19.456 19.456-51.2 19.456-70.656 0-18.944-19.456-18.944-51.2 0-70.656l396.8-396.8c19.456-19.456 51.2-19.456 70.656 0 18.944 19.456 18.944 45.056 0 70.656z"/><path d="M745.472 940.544l-396.8-396.8c-19.456-19.456-19.456-51.2 0-70.656 19.456-19.456 51.2-19.456 70.656 0l403.456 390.144c19.456 25.6 19.456 51.2 0 76.8-26.112 19.968-51.712 19.968-77.312.512zm-564.224-63.488c0-3.584 0-7.68.512-11.264h-.512v-714.24h.512c-.512-3.584-.512-7.168-.512-11.264 0-43.008 21.504-78.336 48.128-78.336s48.128 34.816 48.128 78.336c0 3.584 0 7.68-.512 11.264h.512v714.24h-.512c.512 3.584.512 7.168.512 11.264 0 43.008-21.504 78.336-48.128 78.336s-48.128-35.328-48.128-78.336z"/></svg>',
                    1,
                    '...',
                    array(
                        'wrapTag' => 'ul',
                        'wrapClass' => 'joe_pagination',
                        'itemTag' => 'li',
                        'textTag' => 'a',
                        'currentClass' => 'active',
                        'prevClass' => 'prev',
                        'nextClass' => 'next'
                    )
                );
                ?>
            <?php endif; ?>
        <?php else : ?>
            <div class="joe_comment__close">
                <svg class="joe_comment__close-icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="18" height="18">
                    <path d="M512.307.973c282.317 0 511.181 201.267 511.181 449.587a402.842 402.842 0 0 1-39.27 173.26 232.448 232.448 0 0 0-52.634-45.977c16.384-39.782 25.293-82.688 25.293-127.283 0-211.098-199.117-382.157-444.621-382.157-245.555 0-444.57 171.06-444.57 382.157 0 133.427 79.514 250.88 200.039 319.18v107.982l102.041-65.127a510.157 510.157 0 0 0 142.49 20.122l19.405-.359c19.405-.716 38.758-2.508 57.958-5.427l3.584 13.415a230.607 230.607 0 0 0 22.323 50.688l-20.633 3.328a581.478 581.478 0 0 1-227.123-12.288L236.646 982.426c-19.66 15.001-35.635 7.168-35.635-17.664v-157.39C79.411 725.198 1.024 595.969 1.024 450.56 1.024 202.24 229.939.973 512.307.973zm318.464 617.011c97.485 0 176.794 80.435 176.794 179.2S928.256 976.23 830.77 976.23c-97.433 0-176.742-80.281-176.742-179.046 0-98.816 79.309-179.149 176.742-179.149zM727.757 719.002a131.174 131.174 0 0 0-25.754 78.182c0 71.885 57.805 130.406 128.768 130.406 28.877 0 55.552-9.625 77.056-26.01zm103.014-52.327c-19.712 0-39.117 4.557-56.678 13.312L946.33 854.58c8.499-17.305 13.158-36.864 13.158-57.395 0-71.987-57.805-130.509-128.717-130.509zM512.307 383.13l6.861.358a67.072 67.072 0 0 1 59.853 67.072l-.307 6.86a67.072 67.072 0 0 1-66.407 60.57l-6.81-.358a67.072 67.072 0 0 1-59.852-67.072 67.072 67.072 0 0 1 66.662-67.43zm266.752 0l6.861.358a67.072 67.072 0 0 1 59.853 67.072l-.307 6.86a67.072 67.072 0 0 1-66.407 60.57l-6.81-.358a67.072 67.072 0 0 1-59.852-67.072h-.051l.307-6.86a67.072 67.072 0 0 1 66.406-60.57zm-533.504 0l6.861.358a67.072 67.072 0 0 1 59.853 67.072l-.307 6.86a67.072 67.072 0 0 1-66.407 60.57l-6.81-.358a67.072 67.072 0 0 1-59.852-67.072 67.072 67.072 0 0 1 66.662-67.43z" />
                </svg>
                <?php if ($this->options->JCommentStatus === "off") : ?>
                    <span>已关闭所有页面的评语</span>
                <?php else : ?>
                    <span>已关闭当前页面的评语</span>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>

<?php
function threadedComments($comments, $options)
{
    $commentClass = '';
    $user = Typecho_Widget::widget('Widget_User');
    if ($comments->authorId) {
        if ($user->hasLogin() && $comments->authorId == $comments->ownerId) {
            $commentClass = 'by-author';
        } else {
            $commentClass = 'by-user';
        }
    }
?>
    <li class="comment-list__item">
        <div class="comment-list__item-contain" id="<?php $comments->theId(); ?>">
            <div class="term <?php _getAuthorClass(); ?> <?php echo $commentClass ?>">
                <div class="author">
                    <img width="48" height="48" class="avatar lazyload" src="<?php _getAvatarLazyload() ?>" data-src="<?php _getAvatarByMail($comments->mail); ?>" alt="头像" />
                    <div class="handle">
                        <span class="reply joe_comment__reply" data-id="<?php $comments->theId(); ?>" data-coid="<?php $comments->coid(); ?>">回复</span>
                    </div>
                </div>
                <div class="content">
                    <div class="user">
                        <span class="author">
                            <?php $comments->author(); ?>
                        </span>
                        <span class="meta">
                            <span class="date"><?php echo _dateFormat($comments->created); ?></span>
                            <span class="agent"><?php echo convertip($comments->ip); ?></span>
                        </span>
                        <?php if ($comments->status === "waiting") : ?>
                            <em class="waiting">（评语审核中...）</em>
                        <?php endif; ?>
                    </div>
                    <div class="substance">
                        <?php secretComment($comments); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($comments->children) : ?>
            <div class="comment-list__item-children">
                <?php $comments->threadedComments($options); ?>
            </div>
        <?php endif; ?>
    </li>
<?php } ?>
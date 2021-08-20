            <!-- Top Bar -->
            <div class="top_bar">
                <div class="top_bar_container">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="top_bar_content d-flex flex-row align-items-center justify-content-start">
                                    <ul class="top_bar_contact_list">
                                        <li><div class="question">Have any questions?</div></li>
                                        <li>
                                            <div>(009) 35475 6688933 32</div>
                                        </li>
                                        <li>
                                            <div>info@elaerntemplate.com</div>
                                        </li>
                                    </ul>
                                    <div class="top_bar_login ml-auto">
                                        <ul>
                                            <li>HI,<a href="" style="margin-right: 100px;">
                                                    <span style="color: yellow">
                                                        <?=$this->currentUser?>">
                                                    </span></a></li>
                                            <?php if($this->currentUser ==='Guest'){ ?>
                                            <li><a href="<?=self::ROOT?>/auth/reg">Register</a></li>
                                            <li><a href="<?=self::ROOT?>/auth/entry">Login</a></li>
                                            <?php } else {?>

                                            <li><a href="<?=self::ROOT?>/auth/profile">Profile</a></li>
                                            <li><a href="<?=self::ROOT?>/auth/exit">Exit</a></li>

                                            <?php }?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>				
            </div>
<?php 

$con = new mysqli('localhost','root','','sms_system');

$csqls = $con->query("select count(contact) as tatalcont from contacttb");
$crows = $csqls->fetch_array();

$gsqls = $con->query("select count(gname) as tatalgroup from grouptb");
$grows = $gsqls->fetch_array();


?>

                <section id="main-content">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib"><i class="ti-id-badge color-success border-success"></i>
                                    </div>
                                    <div class="stat-content dib">
                                        <div class="stat-text">Total Groups</div>
                                        <div class="stat-digit"><?php echo $grows['tatalgroup']; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib"><i class="ti-user color-primary border-primary"></i>
                                    </div>
                                    <div class="stat-content dib">
                                        <div class="stat-text">Total Contacts   </div>
                                        <div class="stat-digit"><?php echo $crows['tatalcont']; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib"><i class="ti-email color-pink border-pink"></i>
                                    </div>
                                    <div class="stat-content dib">
                                        <div class="stat-text">SMS Balance</div>
                                        <div class="stat-digit" id="smsbalance"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    
                    </div>
                    
                </section>



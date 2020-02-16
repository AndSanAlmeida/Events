<template>
    <div>
        <!-- Page Header-->
        <header class="page-header">
            <div class="container-fluid">
                <h2 class="no-margin-bottom">Dashboard</h2>
            </div>
        </header>
        <!-- Dashboard Counts Section-->
        <section class="dashboard-counts no-padding-bottom">
            <div class="container-fluid">
                <div class="row bg-white has-shadow">
                    <!-- Item -->
                    <div class="col-xl-3 col-sm-6">
                        <div class="item d-flex align-items-center">
                            <div class="icon bg-violet">
                                <i class="fal fa-user"></i>
                            </div>
                            <div class="title">
                                <span>
                                    New
                                    <br />Clients
                                </span>
                                <div class="progress">
                                    <div
                                        role="progressbar"
                                        style="width: 25%; height: 4px;"
                                        aria-valuenow="25"
                                        aria-valuemin="0"
                                        aria-valuemax="100"
                                        class="progress-bar bg-violet"
                                    ></div>
                                </div>
                            </div>
                            <div class="number">
                                <strong>25</strong>
                            </div>
                        </div>
                    </div>
                    <!-- Item -->
                    <div class="col-xl-3 col-sm-6">
                        <div class="item d-flex align-items-center">
                            <div class="icon bg-red">
                                <i class="fal fa-clipboard"></i>
                            </div>
                            <div class="title">
                                <span>
                                    Work
                                    <br />Orders
                                </span>
                                <div class="progress">
                                    <div
                                        role="progressbar"
                                        style="width: 70%; height: 4px;"
                                        aria-valuenow="70"
                                        aria-valuemin="0"
                                        aria-valuemax="100"
                                        class="progress-bar bg-red"
                                    ></div>
                                </div>
                            </div>
                            <div class="number">
                                <strong>70</strong>
                            </div>
                        </div>
                    </div>
                    <!-- Item -->
                    <div class="col-xl-3 col-sm-6">
                        <div class="item d-flex align-items-center">
                            <div class="icon bg-green">
                                <i class="fal fa-file-invoice"></i>
                            </div>
                            <div class="title">
                                <span>
                                    New
                                    <br />Invoices
                                </span>
                                <div class="progress">
                                    <div
                                        role="progressbar"
                                        style="width: 40%; height: 4px;"
                                        aria-valuenow="40"
                                        aria-valuemin="0"
                                        aria-valuemax="100"
                                        class="progress-bar bg-green"
                                    ></div>
                                </div>
                            </div>
                            <div class="number">
                                <strong>40</strong>
                            </div>
                        </div>
                    </div>
                    <!-- Item -->
                    <div class="col-xl-3 col-sm-6">
                        <div class="item d-flex align-items-center">
                            <div class="icon bg-orange">
                                <i class="fal fa-suitcase-rolling"></i>
                            </div>
                            <div class="title">
                                <span>
                                    Open
                                    <br />Cases
                                </span>
                                <div class="progress">
                                    <div
                                        role="progressbar"
                                        style="width: 50%; height: 4px;"
                                        aria-valuenow="50"
                                        aria-valuemin="0"
                                        aria-valuemax="100"
                                        class="progress-bar bg-orange"
                                    ></div>
                                </div>
                            </div>
                            <div class="number">
                                <strong>50</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Dashboard Header Section    -->
        <section class="dashboard-header">
            <div class="container-fluid">
                <div class="row">
                    <!-- Statistics -->
                    <div class="statistics col-lg-3 col-12">
                        <div
                            class="statistic d-flex align-items-center bg-white has-shadow"
                        >
                            <div class="icon bg-red">
                                <i class="fal fa-tasks"></i>
                            </div>
                            <div class="text">
                                <strong>234</strong>
                                <br />
                                <small>Applications</small>
                            </div>
                        </div>
                        <div
                            class="statistic d-flex align-items-center bg-white has-shadow"
                        >
                            <div class="icon bg-green">
                                <i class="fal fa-calendar"></i>
                            </div>
                            <div class="text">
                                <strong>152</strong>
                                <br />
                                <small>Interviews</small>
                            </div>
                        </div>
                        <div
                            class="statistic d-flex align-items-center bg-white has-shadow"
                        >
                            <div class="icon bg-orange">
                                <i class="fal fa-paper-plane"></i>
                            </div>
                            <div class="text">
                                <strong>147</strong>
                                <br />
                                <small>Forwards</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

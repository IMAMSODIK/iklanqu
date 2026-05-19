<!DOCTYPE html>
<html lang="en">

<head>
    @include('dashboard_layouts.head')
</head>

<body>
    <input type="hidden" id="page" value="pantau">
    <div class="app-container">
        @include('dashboard_layouts.header')

        <div class="content-area" id="content-area">

            <!-- Halaman Pantau -->
            <div class="page" id="page-pantau">

                <div class="page-header">
                    <div class="page-title">Pantau Iklan</div>
                    <div class="page-subtitle">
                        Monitoring impresi iklan realtime
                    </div>
                </div>

                <!-- SUMMARY -->
                <div class="card">

                    <div class="card-item">
                        <div class="item-icon">📺</div>

                        <div class="item-info">
                            <h4>Total Penayangan</h4>
                            <p id="total-play-count">0 kali diputar</p>
                        </div>
                    </div>

                    <div class="card-item">
                        <div class="item-icon">👥</div>

                        <div class="item-info">
                            <h4>Total Viewer</h4>
                            <p id="total-people-count">0 orang melihat</p>
                        </div>
                    </div>

                    <div class="card-item">
                        <div class="item-icon">📊</div>

                        <div class="item-info">
                            <h4>Total Impresi</h4>
                            <p id="total-impression">0 impresi</p>
                        </div>
                    </div>

                </div>

                <!-- LIST KAMPANYE -->
                <div class="card" id="campaign-list">

                    <div
                        style="
                    padding: 20px;
                    text-align: center;
                    color: #999;
                ">
                        Memuat data realtime...
                    </div>

                </div>

            </div>

        </div>

        @include('dashboard_layouts.nav')
    </div>

    @include('dashboard_layouts.script')
    <script>
        async function loadPantauRealtime() {
            try {
                const response = await fetch('/pantau/realtime');
                const result = await response.json();

                if (!result.success) {
                    return;
                }

                const data = result.data;
                document.getElementById('total-play-count').innerHTML = `${data.total_play_count.toLocaleString()} kali diputar`;
                document.getElementById('total-people-count').innerHTML = `${data.total_people_count.toLocaleString()} orang melihat`;
                document.getElementById('total-impression').innerHTML = `${data.total_impression.toLocaleString()} impresi`;

                let html = '';

                data.campaigns.forEach(item => {
                    html += `
                        <div class="card-item">

                            <div class="item-icon">
                                📺
                            </div>

                            <div class="item-info">

                                <h4>
                                    ${item.nama}
                                </h4>

                                <p>
                                    Diputar:
                                    ${item.play_count.toLocaleString()}
                                </p>

                            </div>

                            <span
                                style="
                                    color: #2563eb;
                                    font-weight: 600;
                                "
                            >
                                Viewer: ${item.people_count.toLocaleString()}
                            </span>

                        </div>
                    `;
                });

                document.getElementById('campaign-list').innerHTML = html;
            } catch (e) {
                console.log(e);
            }
        }
        loadPantauRealtime();
        setInterval(() => {
            loadPantauRealtime();
        }, 5000);
    </script>
</body>

</html>

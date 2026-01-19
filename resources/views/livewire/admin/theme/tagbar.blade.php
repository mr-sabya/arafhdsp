<div class="top-tagbar">
    <div class="w-100">
        <div class="row justify-content-between align-items-center">
            <div class="col-md-auto col-9">
                <!-- Alpine.js Real-time Clock -->
                <div class="text-white-50 fs-13"
                    x-data="{ 
                        currentTime: '',
                        updateTime() {
                            const now = new Date();
                            this.currentTime = now.toLocaleString('en-US', { 
                                weekday: 'short', 
                                day: 'numeric', 
                                month: 'short', 
                                year: 'numeric', 
                                hour: '2-digit', 
                                minute: '2-digit', 
                                second: '2-digit', 
                                hour12: true 
                            });
                        }
                     }"
                    x-init="updateTime(); setInterval(() => updateTime(), 1000)">
                    <i class="bi bi-clock align-middle me-2"></i>
                    <span x-text="currentTime"></span>
                </div>
            </div>

            <div class="col-md-auto col-6 d-none d-lg-block">
                <div class="d-flex align-items-center justify-content-center gap-3 fs-13 text-white-50">
                    <div>
                        <i class="bi bi-envelope align-middle me-2"></i> info@gainsit.com
                    </div>
                    <div>
                        <i class="bi bi-globe align-middle me-2"></i> www.gainsit.com
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
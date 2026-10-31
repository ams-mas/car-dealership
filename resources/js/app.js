import './bootstrap';
import Alpine from 'alpinejs';

Alpine.data('dealership', () => ({
    menuOpen: false, filtersOpen: false, saved: [], toast: '', toastTimer: null,
    init() {
        try { const stored = JSON.parse(localStorage.getItem('sadat-saved') || '[]'); this.saved = Array.isArray(stored) ? stored.filter(id => Number.isInteger(id) && id > 0 && id <= 8) : []; } catch { this.saved = []; }
    },
    notify(message) { this.toast = message; clearTimeout(this.toastTimer); this.toastTimer = setTimeout(() => this.toast = '', 3000); },
    toggleSaved(id) {
        const existed = this.saved.includes(id);
        this.saved = existed ? this.saved.filter(value => value !== id) : [...this.saved, id];
        try { localStorage.setItem('sadat-saved', JSON.stringify(this.saved)); this.notify(existed ? 'Vehicle removed from your shortlist.' : 'Vehicle saved to your shortlist.'); } catch { this.notify('Saved for this page. Browser storage is unavailable.'); }
    },
    async shareVehicle() {
        try { await navigator.clipboard.writeText(window.location.href); this.notify('Vehicle link copied.'); } catch { this.notify('Copy the address from your browser to share this vehicle.'); }
    },
}));
Alpine.data('paymentCalculator', (initialPrice = 50000) => ({
    price: initialPrice, down: 10000, apr: 7.5, months: 60,
    get formattedPayment() {
        const price = Number(this.price), down = Number(this.down), apr = Number(this.apr), months = Number(this.months);
        if (![price, down, apr, months].every(Number.isFinite) || price < 0 || down < 0 || apr < 0 || apr > 100 || months <= 0 || down > price) return 'Check your values';
        const principal = Math.max(0, price - down), rate = apr / 1200;
        const payment = rate === 0 ? principal / months : principal * rate / (1 - Math.pow(1 + rate, -months));
        return new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD', maximumFractionDigits: 0 }).format(payment) + ' / mo';
    },
}));
Alpine.data('draftForm', (type) => ({
    message: '', photoCount: 0,
    init() {
        try { const draft = JSON.parse(sessionStorage.getItem('sadat-draft-' + type) || '{}'); this.$nextTick(() => { for (const [name, value] of Object.entries(draft)) { const input = this.$el.elements.namedItem(name); if (input && input.type !== 'file' && !input.value) input.value = value; } }); } catch { /* Drafts are optional. */ }
    },
    saveDraft() {
        const draft = Object.fromEntries([...new FormData(this.$el).entries()].filter(([, value]) => typeof value === 'string'));
        try { sessionStorage.setItem('sadat-draft-' + type, JSON.stringify(draft)); this.message = 'Draft saved in this browser tab. Nothing has been sent to the dealership.'; } catch { this.message = 'Browser storage is unavailable. Nothing has been sent.'; }
    },
}));
window.Alpine = Alpine;
Alpine.start();

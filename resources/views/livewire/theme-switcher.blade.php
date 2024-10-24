<div x-data="{
    theme: localStorage.getItem('hs_theme') || 'light',
    
    isDark() {
        return this.theme === 'dark' || 
            (this.theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches);
    },
    
    initTheme() {
        this.$nextTick(() => {
            if (this.isDark()) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        });

        // Listen for theme changes from other tabs
        window.addEventListener('storage', (event) => {
            if (event.key === 'hs_theme') {
                this.theme = event.newValue || 'light';
                this.toggleTheme(this.theme);
            }
        });
    },
    
    toggleTheme(value = null) {
        this.theme = value || (this.isDark() ? 'light' : 'dark');
        localStorage.setItem('hs_theme', this.theme);
        
        if (this.isDark()) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    }
}" x-init="initTheme()">
    <button 
        type="button" 
        @click="toggleTheme()"
        class="block font-medium text-gray-800 rounded-full hover:bg-gray-200 focus:outline-none focus:bg-gray-200 dark:text-neutral-200 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
        :class="{ 'hidden': isDark() }"
    >
        <span class="inline-flex items-center justify-center group shrink-0 size-9">
            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path>
            </svg>
        </span>
    </button>

    <button 
        type="button" 
        @click="toggleTheme()"
        class="font-medium text-gray-800 rounded-full hover:bg-gray-200 focus:outline-none focus:bg-gray-200 dark:text-neutral-200 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
        :class="{ 'hidden': !isDark() }"
    >
        <span class="inline-flex items-center justify-center group shrink-0 size-9">
            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="4"></circle>
                <path d="M12 2v2"></path>
                <path d="M12 20v2"></path>
                <path d="m4.93 4.93 1.41 1.41"></path>
                <path d="m17.66 17.66 1.41 1.41"></path>
                <path d="M2 12h2"></path>
                <path d="M20 12h2"></path>
                <path d="m6.34 17.66-1.41 1.41"></path>
                <path d="m19.07 4.93-1.41 1.41"></path>
            </svg>
        </span>
    </button>
</div>
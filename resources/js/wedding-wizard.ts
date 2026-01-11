import '../css/app.css';

// Import Vue and required components
import { createApp } from 'vue';
import WeddingWizard from './components/WeddingWizard.vue';

// Import UI components (these should be globally registered or imported)
import { Button } from './components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from './components/ui/card';
import { Input } from './components/ui/input';
import { Label } from './components/ui/label';
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from './components/ui/select';

// Create and mount the Vue app
const app = createApp({
    components: {
        WeddingWizard,
    },
    methods: {
        onWeddingCreated(data) {
            // Handle successful wedding creation
            if (window.onWeddingCreated) {
                window.onWeddingCreated(data);
            }
        },
    },
    template: `
        <div>
            <WeddingWizard @wedding-created="onWeddingCreated" />
        </div>
    `,
});

// Register UI components globally
app.component('Button', Button);
app.component('Card', Card);
app.component('CardContent', CardContent);
app.component('CardHeader', CardHeader);
app.component('CardTitle', CardTitle);
app.component('Input', Input);
app.component('Label', Label);
app.component('Select', Select);
app.component('SelectContent', SelectContent);
app.component('SelectItem', SelectItem);
app.component('SelectTrigger', SelectTrigger);
app.component('SelectValue', SelectValue);

// Mount the app
app.mount('#app');

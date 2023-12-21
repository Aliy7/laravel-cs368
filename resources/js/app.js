import { document } from 'postcss';
import '../css/app.css';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.plugin(focus);
Alpine.start();
document.addEventListeners('DomContentLoaded', () =>{
  console.log("dom loaded")
});
document.addEventListeners('livewire:navigation', () =>{
    console.log("Navigator");
    initFlowbite();
  });
  
  
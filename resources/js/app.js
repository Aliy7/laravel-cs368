import { document } from 'postcss';
import './bootstrap';
import '../css/app.css';

import Alpine from 'alpinejs';



window.Alpine = Alpine;
Alpine.plugin(focus);

Alpine.start();
document.addEventListeners('DomContentLoaded', () =>{
  console.log("dom loaded")
});
document.addEventListeners('livewire:navigated', () =>{
    console.log("Navigator");
    initFlowbite();
  });
  
import { defineStore } from "pinia";
import { ref } from "vue";
export const useAlertStore = defineStore('alert', () => {

    const isOn = ref(false)

    const message = ref('Opération effectuée avec succès !')
    
    const turnAlertOn = () => {
        isOn.value = true 
        if(isOn.value) {
            setTimeout(() => isOn.value = false, 1800)
        }
    }
    return {
        turnAlertOn,
        message,
        isOn
    }
})
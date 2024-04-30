import { defineStore } from "pinia"

export const useAppSettingsStore = defineStore("AppSettings", {
	state: () => {
		return {
			base_url: "http://localhost:5173/",
			base_api_url: "http://localhost:8080/api/v1/"
		}
	}
})

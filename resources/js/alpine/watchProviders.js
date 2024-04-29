import axios from "axios";

export default (countries, apiKey, selectedWatchProviders) => ({
    apiKey: apiKey,
    isOpen: false,
    countries: countries,
    providers: [],
    provider_ids: selectedWatchProviders,
    value: "Indonesia",
    search: "",

    async init() {
        const response = await axios.get(
            "https://api.themoviedb.org/3/watch/providers/tv",
            {
                params: {
                    api_key: this.apiKey,
                    watch_region: "ID",
                },
            }
        );

        this.providers = response.data.results;
    },

    async fetchData(country) {
        this.value = country.english_name;
        this.isOpen = false;

        const response = await axios.get(
            "https://api.themoviedb.org/3/watch/providers/tv",
            {
                params: {
                    api_key: this.apiKey,
                    watch_region: country.iso_3166_1,
                },
            }
        );

        this.providers = response.data.results;
    },
});

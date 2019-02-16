import requests


def get_url(video_id):
    response = requests.get(
        "https://getvideo.p.rapidapi.com/?url=https://www.youtube.com/watch?v="+video_id,
        headers={
            "X-RapidAPI-Key": "LYAff26mlnmsh5UJei43LqicQjtyp1bl77AjsnS8pigMQM43Sj"
        }
    )
    return response.json()['streams'][len(response.json()['streams'])-1]['url']


